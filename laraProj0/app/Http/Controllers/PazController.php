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
use App\Models\Resources\Episodio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\NewEventoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\GestoreEventi;
use App\Http\Requests\NewPazienteRequest;
/*use App\Models\Resources\Attivita;
use App\Models\Resources\Clinico;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\DistMotorio;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;*/



class PazController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;
    protected $gestEventModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
        $this->gestEventModel = new GestoreEventi;
    }
    
    public function index(): View {
        $user = Auth::user();
        $paziente = $user->paziente;
        if (Hash::check('stdpassword', $user->password)) {  /* se la password è quella di default si mostrerà un alert */
            $changed = false;
        } 
        else {
            $changed = true;
        }
        return view('homePaziente')
        ->with('paziente', $paziente)
        ->with('changed', $changed);
    }

    public function edit($username): View{
        $paziente = Paziente::findOrFail($username);
        return view('aggiornaDatiPaziente', compact('paziente'))
        ->with('clinico', $paziente->clinico);
    }

    public function update(NewPazienteRequest $request, $username): Jsonresponse {

        $validatedData = $request->validated();
        $paziente = Paziente::findOrFail($username);
        $riuscito = $this->gestPazModel->updatePaziente($validatedData, $username);
        if (!$riuscito) {
            return response()->json(['error' => 'Errore durante l\'aggiornamento dei dati del paziente.'], 422);
        }
        $paziente->refresh();
        return response()->json(['redirect' => route('homePaziente')]);
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
    
    public function showNuovoEpisodio() : View {
        $userPaz = Auth::user()->paziente->username;
        $disturbi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        return view('inserimentoNuovoEvento', compact('disturbi'))
                ->with('disturbi', $disturbi)
                ->with('userPaz', $userPaz);
    }

    public function storeEpisodio(NewEventoRequest $request): JsonResponse {
        
        $validatedData = $request->validated();
        $riuscito=$this->gestEventModel->storeEpisodio($validatedData);
        
        if ($riuscito) {
            return response()->json(['redirect' => route('homePaziente')]);
        }
        else {
            return response()->json(['error' => 'Errore durante l\'aggiunta dell\'episodio.'], 422);
        }
    }
}
