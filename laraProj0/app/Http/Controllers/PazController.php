<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Paziente;
use App\Models\User;
use App\Models\GestoreCartelleClin;
use App\Models\GestoreTerapie;
use App\Models\GestoreDistubi;
use App\Models\GestorePazienti;
use App\Models\GestoreClinici;
/*use App\Models\Resources\Attivita;
use App\Models\Resources\Clinico;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\DistMotorio;
use App\Models\Resources\Episodio;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;*/



class PazController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
    }
    
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
            'dataNasc' => 'required|date|before:today|date_format:Y-m-d'    ,
            'genere' => 'required|string|max:1',
            'via' => 'required|string|max:30',
            'civico' => 'required|string|max:5',
            'citta' => 'required|string|max:30',
            'prov' => 'required|string|max:2',
            'telefono' => 'required|string|max:13',
            'email' => 'required|string|email|max:40|unique:paziente,email',
        ]);

        $paziente = Paziente::findOrFail($username);

        $paziente->update($request->all());
        
        return redirect()->route('homePaziente', ['username' => $paziente->username ])->with('success', 'Dati paziente aggiornati con successo.');
    }

    public function showCartClinica() : View {

        $paziente = Auth::user()->paziente;
        $userPaz = $paziente->username;
        $episodi = $this->gestCartModel->getEpisodiByPaz($userPaz)->sortByDesc('data');
        $disturbi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        $terapia = $this->gestCartModel->getTerapiaAttivaByPaz($userPaz);
        $terId = $terapia->id;
        $farmaci = $this->gestTerModel->getFarmaciFreqByTer($terId);
        $attivita = $this->gestTerModel->getAttivitaFreqByTer($terId);

        return view('cartellaClinicaPaziente')
                ->with('paziente', $paziente)
                ->with('episodi', $episodi)
                ->with('disturbi', $disturbi)
                ->with('farmaci', $farmaci)
                ->with('attivita', $attivita);

    }

    public function showPassChange() : View {
        return view('cambiaPwdPaziente');
    }
}
