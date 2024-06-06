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

class GestoreMessaggi extends Model
{
    public function getMsgRicevuti($username) : Collection {

        $messaggi = new Collection;

        foreach(Messaggio::where('destin', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $mittente = Paziente::find($msg->mittente);  // il mittente è sicuramente un paziente
                $msg->mittente = $mittente;  // 
                $messaggi->add($msg);
            }

            else if (Auth::user()->usertype == 'P') {
                $mittente = Clinico::find($msg->mittente);  // il mittente è sicuramente un clinico
                $msg->mittente = $mittente;  // 
                $messaggi->add($msg);
            }
        }
        return $messaggi;
    }

    public function getMsgInviati($username) : Collection {

        $messaggi = new Collection;

        foreach(Messaggio::where('mittente', $username)->get() as $msg) {

            if (Auth::user()->usertype == 'C') {
                $destinatario = Paziente::find($msg->destinatario);  // il destinatario è sicuramente un paziente
                $msg->destinatario = $destinatario;  // 
                $messaggi->add($msg);
            }

            else if (Auth::user()->usertype == 'P') {
                $destinatario = Clinico::find($msg->destinatario);  // il destinatario è sicuramente un clinico
                $msg->destinatario = $destinatario;  // 
                $messaggi->add($msg);
            }
        }
        return $messaggi;
    }
}
