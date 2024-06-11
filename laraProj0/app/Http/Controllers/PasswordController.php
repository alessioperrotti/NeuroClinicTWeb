<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update_pwd(Request $request)
    {
        //validazione dei dati della form
        $request->validate([
            'vecchiaPassword' => 'required', 
            'nuovaPassword' => 'required|min:8',
            'confermaPassword' => 'required'
        ]);

        $user = Auth::user(); //recupero l'utente autenticato   

        //controllo se la password attuale è corretta
        if(!Hash::check($request['vecchiaPassword'], $user->password)) {
            return back()->withErrors(['vecchiaPassword' => 'La password attuale non è corretta']);
        }

        if($request['vecchiaPassword'] == $request['nuovaPassword']) {
            return back()->withErrors(['nuovaPassword' => 'La nuova password non può essere uguale a quella attuale']);
        }

        if($request['nuovaPassword'] != $request['confermaPassword']) {
            return back()->withErrors(['confermaPassword' => 'La password non coincide ']);
        }

        //aggiorno la password
        $user->password = Hash::make($request->nuovaPassword);
        $user->save();

        Auth::logout(); //logout dell'utente

        return redirect()->route('login')->with('status', 'Password modificata con successo');  //password cambiata con successo
    }


}
