<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDisturboRequest;
use App\Http\Requests\NewFarmacoRequest;
use App\Http\Requests\UpdateDisturboRequest;
use App\Http\Requests\UpdateFarmacoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\GestoreFarmaci;
use App\Models\GestoreTerapie;
use App\Models\Resources\DistMotorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    protected $disturbiModel;
    protected $farmaciModel;
    protected $terapieModel;
    protected $pazienti;


    public function __construct()
    {

        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
        $this->farmaciModel = new GestoreFarmaci();
    }

    public function index()
    {
        $user = Auth::user();
        $admin = $user->paziente;
        return view('homeAdmin');
    }

    //DISTURBI
    public function viewDisturbi()
    {
        Log::info('metodo viewDisturbo attivato');
        $disturbi = $this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi', $disturbi);
    }

    public function storeDisturbo(NewDisturboRequest $request): RedirectResponse
    {


        Log::info('metodo storeDisturbo attivato');
        $validatedData = $request->validated();


        $riuscito = $this->disturbiModel->storeDisturbo($validatedData);

        if ($riuscito) {
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del disturbo.');
        } else {
            return redirect()->route('gestioneDisturbi');
        }
    }

    public function deleteDisturbo(Request $request)
    {
        $validated = $request->validate([
            'idDel' => 'required',
        ]);

        $riuscito = $this->disturbiModel->deleteDisturbo($validated);

        if ($riuscito) {
            return redirect()->route('gestioneDisturbi');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del disturbo.');
        }
    }
    
    public function updateDisturbo(UpdateDisturboRequest $request)
    {
        $validated = $request->validated();

        $riuscito = $this->disturbiModel->updateDisturbo($validated);

        if ($riuscito) {
            return redirect()->route('gestioneDisturbi');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del disturbo.');
        }
    }
    

    //FARMACI

    
    public function viewFarmaci()
    {
        $farmaci = $this->farmaciModel->getFarmaci();
        return view('gestioneFarmaciAttivita')->with('farmaci', $farmaci);

    }
    public function storeFarmaco(NewFarmacoRequest $request)
    {
        $validatedData = $request->validated();


        $riuscito = $this->farmaciModel->storeFarmaco($validatedData);

        if ($riuscito) {
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del farmaco.');
        } else {
            return redirect()->route('gestioneFarmaciAttivita');
        }

    }    

    public function deleteFarmaco(Request $request)
    {
        $validated = $request->validate([
            'idDel' => 'required',
        ]);

        $riuscito = $this->farmaciModel->deleteFarmaco($validated);

        if ($riuscito) {
            return redirect()->route('gestioneFarmaciAttivita');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del farmaco.');
        }
    }

    public function updateFarmaco(UpdateFarmacoRequest $request)
    {
        $validated = $request->validated();

        $riuscito = $this->farmaciModel->updateFarmaco($validated);

        if ($riuscito) {    
            return redirect()->route('gestioneFarmaciAttivita');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del farmaco.');
        }
    }
    


    



  


    
}
