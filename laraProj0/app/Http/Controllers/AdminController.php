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
use App\Models\GestorePazienti;
use App\Models\Resources\Paziente;
use App\Models\Resources\Faq;
use App\Models\GestoreFaq;
use App\Models\GestoreClinici;
use App\Models\Resources\Episodio;
use App\Models\Resources\Terapia;
use App\Models\Resources\Clinico;
use App\Http\Requests\NewFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\NewClinicoRequest;
use App\Http\Requests\UpdateClinicoRequest;


class AdminController extends Controller
{
    protected $disturbiModel;
    protected $farmaciModel;
    protected $attivitaModel;
    protected $pazientiModel;
    protected $cliniciModel;
    protected $faqModel;

    public function __construct()
    {

        Log::info('AdminController inizializzato');
        #$this->middleware('can:isAdmin');
        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi;
        $this->farmaciModel = new GestoreFarmaci;
        $this->attivitaModel = new GestoreAttivita;
        $this->pazientiModel= new GestorePazienti;
        $this->cliniciModel= new GestoreClinici;
        $this->faqModel= new GestoreFaq;
          
    }

    public function index()
    {
        $user = Auth::user();
        $admin = $user->paziente;
        return view('homeAdmin'); 
    }
################################################################################################
    #SEZIONE PAZIENTI   
    public function mostraPazienti()
    {
        $pazienti=$this->pazientiModel->getPazienti();
        #return view('listaPaz')->with('pazienti',$pazienti);
        return response()
        ->view('listaPaz', ['pazienti' => $pazienti]);
        
    } 
    public function eliminaPaziente($username)
    {
        $this->pazientiModel->eliminaPaz($username);
        $pazienti = $this->pazientiModel->getPazienti();  #non funziona se chiamo $this->mostraPazienti(); 
        return redirect()->route('listaPaz');   
    }
   #SEZIONA FAQ
    public function viewGestioneFaq()
    {
        $faqs=$this->faqModel->getFaqs();
        return view('gestioneFaq')->with('faqs',$faqs); 
    }
    public function eliminaFaq($id)
    {
        $this->faqModel->deleteFaq($id);
        return redirect()->route('gestioneFaq');
    }

    public function storeFaq(NewFaqRequest $request): JsonResponse
    {
        Log::info('metodo storeFaq attivato');
        $validatedData = $request->validated();

        if ($this->faqModel->storeFaq($validatedData)){
            Log::info('FAQ salvata correttamente, reindirizzamento a gestioneFaq');
            return response()->json(['redirect' => route('gestioneFaq')]); 
        }
        else{
            Log::error('Errore durante l\'aggiunta della FAQ');
            return response()->json(['error' => 'Regole non rispettate.'], 422);
        }
        
    }

    public function updateFaq(NewFaqRequest $request, $id): JsonResponse
    {
        Log::info('metodo updateFaq attivato');
        $validatedData = $request->validated();
       
        if($this->faqModel->updateFaq($validatedData, $id))
        {
            Log::info('FAQ modificata correttamente, reindirizzamento a gestioneFaq');
            return response()->json(['redirect' => route('gestioneFaq')]); 
        } 
       else
       {
            Log::error('Errore durante la modifica della FAQ');
            return response()->json(['error' => 'Regole non rispettate.'], 422);
        }
    }

    #SEZIONE CLINICI
    public function viewGestioneClinici()
    {
        $clinici=$this->cliniciModel->getClinici();
        return view('gestioneClinici')->with('clinici',$clinici); 
    }
    //AGGIUNGI CLINICO
    public function viewNuovoClinico()
    {
        return view('newClinico');
    }
    // Elimina un clinico
    public function eliminaClinico($id): RedirectResponse
    {
        if(!$this->cliniciModel->deleteClinico($id))        
            return redirect()->back()->with('success', 'Clinico eliminato con successo.');
        else
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del clinico.');
        
    }
    public function storeClinico(NewClinicoRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        if($this->cliniciModel->storeClinico($validatedData)){
            return response()->json(['redirect' => route('gestioneClinici')]);
        }else
            return response()->json(['error' => 'Regole non rispettate.'], 422);
    }
    public function viewAggiornaClinico($userClin)
    {
        $clinico = $this->cliniciModel->getClinico($userClin);
        return view('editClinico')->with('clinico', $clinico);
    }
    public function updateClinico(UpdateClinicoRequest  $request ,$userClin):JsonResponse
    {
        $validatedData = $request->validated();
        log::info("dati validati");
        if($this->cliniciModel->updateClinico($validatedData, $userClin))
            return response()->json(['redirect' => route('gestioneClinici')]);
        else
            return response()->json(['error' => 'Regole non rispettate.'], 422);
    }

    #ANALISI DEI DATI
    public function viewAnalisiDati()
    {
        $pazienti = $this->pazientiModel->getPazienti();
        foreach ($pazienti as $paziente) {
            $paziente->numeroCambiTerapia = $this->getNumeroCambiTerapia($paziente->username);
        }
        $mediaPazientiPerClinico = $this->cliniciModel->mediaPazientiPerClinico();
        $mediaDisturbiPerPaziente = $this->pazientiModel->mediaDisturbiMotoriPerPaziente();
        $disturbiMotori = $this->disturbiModel->getDisturbi();
        return view('analisiDati')
            ->with('mediaPazientiPerClinico',$mediaPazientiPerClinico)
            ->with('mediaDisturbiPerPaziente',$mediaDisturbiPerPaziente)
            ->with('disturbiMotori',$disturbiMotori)
            ->with('pazienti', $pazienti);
    }
    public function getEpisodiDisturbo($id)
    {
        $numeroEpisodi = Episodio::where('disturbo', $id)->count();
        return response()->json(['numeroEpisodi' => $numeroEpisodi]);
    }
    public function getNumeroCambiTerapia($username) {
        $numeroTerapie = Terapia::where('paziente', $username)->count();
        $numeroCambiTerapia = $numeroTerapie - 1;
        return $numeroCambiTerapia;
    }

####################################################################################################################

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
