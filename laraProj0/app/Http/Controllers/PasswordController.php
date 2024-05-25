<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'vecchiaPwd' => 'required',    
        ]);

        $user = Auth::user(); //recupero l'utente autenticato   

        //controllo se la password attuale è corretta
        if(!Hash::check($request->vecchiaPwd, $user->password)) {
            return back()->withErrors(['vecchiaPwd' => 'La password attuale non è corretta']);
        }

        if($request->nuovaPwd != $request->confermaPwd) {
            return back()->withErrors(['confermaPwd' => 'La password non coincide ']);
        }

        //aggiorno la password
        $user->password = Hash::make($request->nuovaPwd);
        $user->save();

        Auth::logout(); //logout dell'utente

        return redirect()->route('login')->with('status', 'Password modificata con successo');  //password cambiata con successo
    }


}
