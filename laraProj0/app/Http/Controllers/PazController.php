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
        $request->validate([
            'nome' => 'required|string|max:30|alpha',
            'cognome' => 'required|string|max:30|alpha',
            'dataNasc' => 'required|date|before:today|date_format:Y-m-d',
            'genere' => 'required|string|max:1',
            'via' => 'required|string|max:30',
            'civico' => 'required|string|max:5',
            'citta' => 'required|string|max:30',
            'prov' => 'required|string|max:2',
            'telefono' => 'required|string|max:13',
            'email' => 'required|string|email|max:40|unique:paziente,email,',
        ]);

        $paziente = Paziente::findOrFail($username);

        $paziente->update($request->all());
        
        return redirect()->route('homePaziente', ['username' => $paziente->username ])->with('success', 'Dati paziente aggiornati con successo.');
    }
}
