<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDisturboRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\Resources\DistMotorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    protected $disturbiModel;
    protected $pazienti;
    protected $disturboDaModi=0;

    public function __construct()
    {
        
        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
      
          
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
        $disturbi=$this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi',$disturbi)->with('disturboDaModificare',$this->disturboDaModi);
    }
   

    public function storeDisturbo(NewDisturboRequest $request): RedirectResponse {
    

        Log::info('metodo storeDisturbo attivato');
        $validatedData = $request->validated();

        $disturbo = new DistMotorio();
        $disturbo->fill($validatedData);
        $disturbo->save();


        

 

        //return redirect()->action([AdminController::class, 'index']);
        return redirect()->route('gestioneDisturbi');
       
        
    }

    public function deleteDisturbo($id)
    {
        $this->disturbiModel->deleteDisturbo($id);
        $this->disturbiModel->getDisturbi();
        return redirect()->route('gestioneDisturbi');

        
    }

    // public function updateDisturbo(NewDisturboRequest $request,$id):RedirectResponse
    // {
    //     $validatedData = $request->validated();
    //     $disturbo = DistMotorio::find($id);
    //     $disturbo->fill($validatedData);
    //     $disturbo->save();
    //     return redirect()->route('gestioneDisturbi.view');
    // }
    
    public function updateDisturbo(Request $request)
    {
        $validated = $request->validate([
            'idMod' => 'required',
            'nomeMod' => 'required|max:30',
            'categoriaMod' => 'required|max:30',
        ]);

        $id = $validated['idMod'];
        $disturbo = DistMotorio::findOrFail($id);
        $disturbo->nome = $validated['nomeMod'];
        $disturbo->categoria = $validated['categoriaMod'];
        $disturbo->save();

        return redirect()->route('gestioneDisturbi');
    }

    public function updateDisturboDaMod(Request $request)
    {
        // Ricevi il nuovo valore della variabile tramite AJAX
        $newVariable = $request->input('variable');
        Log::info($newVariable);
        
        // aggiorna la variabile Php
        $this->disturboDaModi = $newVariable;
        Log::info($this->disturboDaModi);
        


        // In questo esempio, semplicemente ritorna una risposta con il nuovo valore
        return response()->json(['disturboDaMod' => $newVariable]);
    }
    
    



}
