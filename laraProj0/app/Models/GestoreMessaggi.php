<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Messaggio;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Paziente;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Clinico;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Log;

class GestoreMessaggi extends Model
{   
    public function trovaPersona($username)
    {
        $persona = Paziente::find($username);
        if ($persona === null) {
            $persona = Clinico::find($username);
        }
        return $persona;
    }
    

    public function getMsgRicevuti($username): Collection
    {

        $messaggi = new Collection;

        foreach (Messaggio::where('destin', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $mittente = Paziente::find($msg->mittente);  // il mittente è sicuramente un paziente
                $msg->mittente = $mittente;

                //se i messaggi hanno una risposta avranno dei valori diversi da null
                if ($msg->risposta != null) {

                    $risposta = Messaggio::find($msg->risposta);
                    $mittente = $this->trovaPersona($risposta->mittente);
                    $risposta->mittente = $mittente;
                    $msg->risposta = $risposta;

                }

                if(!$msg->eliminatoClin){  // se è stato eliminato dal clinico non va mostrato

                    $messaggi->add($msg);
                }

            } else if (Auth::user()->usertype == 'P') {
                $mittente = Clinico::find($msg->mittente);  // il mittente è sicuramente un clinico
                $msg->mittente = $mittente;


                if ($msg->risposta != null) {

                    $risposta = Messaggio::find($msg->risposta);
                    $mittente = $this->trovaPersona($risposta->mittente);
                    $risposta->mittente = $mittente;
                    $msg->risposta = $risposta;
                }

                if(!$msg->eliminatoPaz){  // se è stato eliminato dal paziente non va mostrato

                    $messaggi->add($msg);
                }
            }
        }
        return $messaggi;
    }

    public function getMsgInviati($username): Collection
    {

        $messaggi = new Collection;

        foreach (Messaggio::where('mittente', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $destinatario = Paziente::find($msg->destin);  // il destinatario è sicuramente un paziente
                $mittente = Clinico::find(Auth::user()->username);
                $msg->destin = $destinatario;
                $msg->mittente = $mittente;


                //se i messaggi hanno una risposta avranno dei valori diversi da null
                if ($msg->risposta != null) {
                    $risposta = Messaggio::find($msg->risposta);
                    $mittente = $this->trovaPersona($risposta->mittente);
                    $risposta->mittente = $mittente;
                    $msg->risposta = $risposta;
                }

                if(!$msg->eliminatoClin){  // se è stato eliminato dal clinico non va mostrato

                    $messaggi->add($msg);
                }

            } else if (Auth::user()->usertype == 'P') {
                $destinatario = Clinico::find($msg->destin);  // il destinatario è sicuramente un clinico
                $mittente = Paziente::find(Auth::user()->username);
                $msg->destin = $destinatario;
                $msg->mittente = $mittente;

                //se i messaggi hanno una risposta avranno dei valori diversi da null
                if ($msg->risposta != null) {
                    $risposta = Messaggio::find($msg->risposta);

                    $mittente = $this->trovaPersona($risposta->mittente);
                    $risposta->mittente = $mittente;
                    $msg->risposta = $risposta;
                }

                if(!$msg->eliminatoPaz){  // se è stato eliminato dal paziente non va mostrato

                    $messaggi->add($msg);
                }
            }

            /* si sono "sovraccaricati" gli attributi di messaggio con i dati dei mittenti e destinatari.
            Nota che nel db rimangono solamente le chiavi, questo metodo serve per permettere alla vista di 
            ottenere più informazioni. */
        }
        return $messaggi;
    }

    public function sendMessaggio($validatedData): bool
    {
        $messaggio = new Messaggio(
            [
                'mittente' => Auth::user()->username,
                'destin' => $validatedData['destin'],
                'contenuto' => $validatedData['contenuto'],

            ]
        );
        $messaggio->letto = false;
        $messaggio->eliminatoClin = false;
        $messaggio->eliminatoPaz = false;
        if (isset($validatedData['risposta'])) {
            $messaggio->risposta = $validatedData['risposta'];
        }

        try {

            $messaggio->save();
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
        return true;
    }

    public function deleteMessaggiByUser($username) {

        $messaggi = Messaggio::where('mittente', $username)->orWhere('destin', $username)->get();

        foreach($messaggi as $msg) {
            
            $msg->delete();
        }
        
    }


}
