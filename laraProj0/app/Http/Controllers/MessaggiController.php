<?php

namespace App\Http\Controllers;

use App\Models\GestoreMessaggi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessaggiController extends Controller
{
    protected $messaggiModel;
    
    public function __construct()
    {   
        $this->messaggiModel = new GestoreMessaggi();
    }

    public function getConversazione(Request $request){
        $validated = $request->validate([
            'mandante' => 'required',
            'ricevente' => 'required',
        ]);
        
        $messaggi = $this->messaggiModel->getConversazione($validated);

        return $messaggi;
    }

    public function sendMessaggio(Request $request){

        $validated = $request->validate([
            'mandante' => 'required',
            'ricevente' => 'required',
            'contenuto' => 'required',
        ]);

        $this->messaggiModel->sendMessaggio($validated);

    }
}
