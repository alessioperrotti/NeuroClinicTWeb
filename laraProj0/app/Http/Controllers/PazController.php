<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Paziente;
use App\Models\User;


class PazController extends Controller
{
    public function index(): View {
        $user = Auth::user();
        $paziente = $user->paziente;
        return view('homePaziente')->with('paziente', $paziente);
    }

    public function edit($username) {
        $paziente = Paziente::findOrFail($username);
        return view('aggiornaDatiPaziente', compact('paziente'));
    }

    public function update(Request $request, $username)
    {
        /*$request->validate([
            'nome' => 'required|string|max:30',
            'cognome' => 'required|string|max:30',
            'dataNasc' => 'required|date',
            'genere' => 'required|string|max:1',
            'via' => 'required|string|max:30',
            'telefono' => 'required|string|max:13',
            'email' => 'required|string|max:40|email',
            'username' => 'required|string|max:20',
            
        ]);*/

        $paziente = Paziente::findOrFail($username);

        $paziente->update($request->all());
        
        return redirect()->route('homePaziente', ['username' => $paziente->username ])->with('success', 'Dati paziente aggiornati con successo.');
    }
}
