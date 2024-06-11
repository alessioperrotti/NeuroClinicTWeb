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
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\NewClinicoRequest;
use App\Http\Requests\UpdateClinicoRequest;
use App\Models\GestoreCartelleClin;
use App\Http\Requests\FaqRequest;


class AdminController extends Controller
{
    protected $disturbiModel;
    protected $farmaciModel;
    protected $attivitaModel;
    protected $pazientiModel;
    protected $cliniciModel;
    protected $faqModel;
    protected $cartelleModel;

    public function __construct()
    {
        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi;
        $this->farmaciModel = new GestoreFarmaci;
        $this->attivitaModel = new GestoreAttivita;
        $this->pazientiModel= new GestorePazienti;
        $this->cliniciModel= new GestoreClinici;
        $this->faqModel= new GestoreFaq;
        $this->cartelleModel= new GestoreCartelleClin;
          
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


   #SEZIONE FAQ
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


    public function storeFaq(FaqRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        if ($this->faqModel->storeFaq($validatedData)){
            return response()->json(['redirect' => route('gestioneFaq')]); 
        }
        else{
            return response()->json(['error' => 'Regole non rispettate.'], 422);
        }
        
    }

    public function updateFaq(FaqRequest $request, $id): JsonResponse
    {
        $validatedData = $request->validated();
       
        if($this->faqModel->updateFaq($validatedData, $id))
        {
            return response()->json(['redirect' => route('gestioneFaq')]); 
        } 
       else
       {
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
            $paziente->numeroCambiTerapia = $this->pazientiModel->getNumeroCambiTerapia($paziente->username);
            $disturbi=                      $this->cartelleModel->getDisturbiByPaz($paziente->username);
            $paziente->mediaEventiDiDisturbi = $this->pazientiModel->mediaEventiDiDisturbi($paziente,$disturbi);
        }
        $mediaPazientiPerClinico = $this->cliniciModel->mediaPazientiPerClinico();
        $disturbiMotori = $this->disturbiModel->getDisturbi();
        return view('analisiDati')
            ->with('mediaPazientiPerClinico',$mediaPazientiPerClinico)
            ->with('disturbiMotori',$disturbiMotori)
            ->with('pazienti', $pazienti);
    }
    public function getEpisodiDisturbo($id)
    {
        $numeroEpisodi = Episodio::where('disturbo', $id)->count();
        return response()->json(['numeroEpisodi' => $numeroEpisodi]);
    }

####################################################################################################################

    //DISTURBI
    public function viewDisturbi()
    {
        $disturbi = $this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi', $disturbi);
    }

    public function storeDisturbo(DisturboRequest $request): JsonResponse
    {
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
        $validated['id'] = $request->input('id');

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
        $riuscito = $this->farmaciModel->storeFarmaco($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 

        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta del farmaco.'], 422);
        }
    }    

    public function deleteFarmaco($farmId)
    {
        
        $riuscito = $this->farmaciModel->deleteFarmaco($farmId);

        if ($riuscito) {
            return redirect()->route('gestioneFarmaciAttivita');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del farmaco.');
        }
    }

    public function updateFarmaco(FarmacoRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['id'] = $request->input('id');

        $riuscito = $this->farmaciModel->updateFarmaco($validated);

        if ($riuscito) {    
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante la modifica del farmaco.'], 422);
        }
    }

    

    //attivita
    
    public function storeAttivita(AttivitaRequest $request):JsonResponse{
        
        $validatedData = $request->validated();
        $riuscito = $this->attivitaModel->storeAttivita($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta dell\'attivita.'], 422);
        }
    }

    public function deleteAttivita($attId)
    {
        
        $riuscito = $this->attivitaModel->deleteAttivita($attId);

        if ($riuscito) {
            return redirect()->route('gestioneFarmaciAttivita');
        } else {
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione dell\'attività.');
        }
    }

    public function updateAttivita(AttivitaRequest $request):JsonResponse
    {
        $validated = $request->validated();
        $validated['id'] = $request->input('id');

        $riuscito = $this->attivitaModel->updateAttivita($validated);

        if ($riuscito) {
            return response()->json(['redirect' => route('gestioneFarmaciAttivita')]); 
        } else {
            return response()->json(['error' => 'Errore durante la modifica dell\'attivita.'], 422);
        }
    }
    
}
