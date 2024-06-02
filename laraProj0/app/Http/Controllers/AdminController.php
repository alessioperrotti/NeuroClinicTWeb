<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttivitaRequest;
use App\Http\Requests\DisturboRequest;
use App\Http\Requests\FarmacoRequest;
use App\Http\Requests\NewDisturboRequest;
use App\Http\Requests\NewFarmacoRequest;
use App\Http\Requests\UpdateDisturboRequest;
use App\Http\Requests\UpdateFarmacoRequest;
use App\Models\GestoreAttivita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\GestoreFarmaci;
use App\Models\GestoreTerapie;
use App\Models\Resources\DistMotorio;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

class AdminController extends Controller
{

    protected $disturbiModel;
    protected $farmaciModel;
    protected $attivitaModel;
    protected $pazienti;


    public function __construct()
    {

        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
        $this->farmaciModel = new GestoreFarmaci();
        $this->attivitaModel = new GestoreAttivita();
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

    public function storeDisturbo(DisturboRequest $request): JsonResponse
    {


        Log::info('metodo storeDisturbo attivato');
        $validatedData = $request->validated();


        $riuscito = $this->disturbiModel->storeDisturbo($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneDisturbi')]); 

        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta del disturbo.'], 422);

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
    
    public function updateDisturbo(DisturboRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $riuscito = $this->disturbiModel->updateDisturbo($validated);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneDisturbi')]); 
        } else {
            return response()->json(['error' => 'Errore durante la modifica del disturbo.'], 422);
        }
    }
    


    //VISTA FARMACI_ATTIVITA
    //farmaci
    public function viewFarmaciAttivita()
    {
        $farmaci = $this->farmaciModel->getFarmaci();
        $attivita = $this->attivitaModel->getAttivita();
        return view('gestioneFarmaciAttivita')->with('farmaci', $farmaci)->with('attivita',$attivita);

    }
    

    public function storeFarmaco(FarmacoRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        Log::info('metodo storeFarmaco attivato');
        $riuscito = $this->farmaciModel->storeFarmaco($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 

        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta del farmaco.'], 422);
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

    public function updateFarmaco(FarmacoRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $riuscito = $this->farmaciModel->updateFarmaco($validated);

        if ($riuscito) {    
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante la modifica del farmaco.'], 422);
        }
    }

    

    //attivita
    
    public function storeAttivita(AttivitaRequest $request):JsonResponse{
        Log::info($request);
        $validatedData = $request->validated();
        Log::info('metodo storeAttivita attivato');

        $riuscito = $this->attivitaModel->storeAttivita($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta dell\'attivita.'], 422);
        }
    }

    public function deleteAttivita(Request $request)
    {
        $validated = $request->validate([
            'idDel' => 'required',
        ]);

        $riuscito = $this->attivitaModel->deleteAttivita($validated);

        if ($riuscito) {
            return redirect()->route('gestioneFarmaciAttivita');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione dell\'attività.');
        }
    }

    public function updateAttivita(AttivitaRequest $request):JsonResponse
    {
        Log::info($request);
        $validated = $request->validated();

        $riuscito = $this->attivitaModel->updateAttivita($validated);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante la modifica dell\'attivita.'], 422);
        }
    }

    


    



  


    
}
