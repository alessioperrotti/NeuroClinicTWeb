<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDisturboRequest;
use App\Http\Requests\UpdateDisturboRequest;
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


  


    
}
