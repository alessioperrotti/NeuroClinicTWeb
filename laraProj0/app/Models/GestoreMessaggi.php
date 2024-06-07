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
use Illuminate\Support\Facades\Log;

class GestoreMessaggi extends Model
{
    public function getMsgRicevuti($username) : Collection {

        $messaggi = new Collection;

        foreach(Messaggio::where('destin', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $mittente = Paziente::find($msg->mittente);  // il mittente è sicuramente un paziente
                $msg->mittente = $mittente;  
                $messaggi->add($msg);
            }

            else if (Auth::user()->usertype == 'P') {
                $mittente = Clinico::find($msg->mittente);  // il mittente è sicuramente un clinico
                $msg->mittente = $mittente;  
                $messaggi->add($msg);
            }
        }
        return $messaggi;
    }

    public function getMsgInviati($username) : Collection {

        $messaggi = new Collection;

        foreach(Messaggio::where('mittente', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $destinatario = Paziente::find($msg->destin);  // il destinatario è sicuramente un paziente
                $mittente = Clinico::find(Auth::user()->username);
                $msg->destin = $destinatario;
                $msg->mittente = $mittente;  
                $messaggi->add($msg);
            }

            else if (Auth::user()->usertype == 'P') {
                $destinatario = Clinico::find($msg->destin);  // il destinatario è sicuramente un clinico
                $mittente = Paziente::find(Auth::user()->username);
                $msg->destin = $destinatario;  
                $msg->mittente = $mittente;
                $messaggi->add($msg);
            }

            /* si sono "sovraccaricati" gli attributi di messaggio con i dati dei mittenti e destinatari.
            Nota che nel db rimangono solamente le chiavi, questo metodo serve per permettere alla vista di 
            ottenere più informazioni. */
        }
        return $messaggi;
    }

    public function sendMessaggio($validatedData) : bool {


        $messaggio = new Messaggio(
            [
                'mittente' => Auth::user()->username,
                'destin' => $validatedData['destin'],
                'contenuto' => $validatedData['contenuto']
            ]
        );
        $messaggio->letto = false;

        try {
            $messaggio->save();
        } catch (\Exception $e) {
            return false;
        }
        return true;

    }
}
