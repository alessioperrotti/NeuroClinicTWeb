<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorePazienti;
use App\Models\Resources\Paziente;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\GestoreFaq;
use App\Models\GestoreClinici;
use App\Models\Resources\Episodio;
use App\Models\Resources\Terapia;
use App\Models\Resources\Clinico;
use App\Http\Requests\NewFaqRequest;
use App\Http\Requests\NewClinicoRequest;
use App\Http\Requests\UpdateClinicoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $adminModel;
    protected $pazientiModel;
    protected $disturbiModel;
    protected $cliniciModel;

    public function __construct()
    {

        Log::info('AdminController inizializzato');
        #$this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
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
#    public function storeFaq(NewFaqRequest $request) : RedirectResponse 
#    {
#        $validatedData = $request->validated();
#        if($this->faqModel->storeFaq($validatedData)) 
#            return redirect()->action([AdminController::class, 'viewGestioneFaq'])->with('success', 'FAQ aggiunta con successo.');
#        else
 #           return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio della FAQ.');
#    }
    public function storeFaq(NewFaqRequest $request): JsonResponse
    {
        Log::info('metodo storeFaq attivato');
        $validatedData = $request->validated();

        if ($this->faqModel->storeFaq($validatedData)) {
            return response()->json(['redirect' => route('gestioneFaq')]); 

        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta del disturbo.'], 422);

        }
    }

    public function updateFaq(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'risposta' => 'required|string'
        ]);
        
        if(!$this->faqModel->updateFaq($validatedData, $id))
            return redirect()->action([AdminController::class, 'viewGestioneFaq']);
        else
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'aggiornamento della FAQ.');
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
    public function storeClinico(NewClinicoRequest $request): RedirectResponse
    {
        log::info('metodo storeClinico del controller attivato');
        $validatedData = $request->validated();
        if($this->cliniciModel->storeClinico($validatedData))
            return redirect()->action([AdminController::class, 'viewGestioneClinici']);
        else
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del clinico.');
    }
    public function viewAggiornaClinico($userClin)
    {
        $clinico = $this->cliniciModel->getClinico($userClin);
        return view('editClinico')->with('clinico', $clinico);
    }
    public function updateClinico(UpdateClinicoRequest  $request ,$userClin)
    {
        
        log::info('metodo updateClinico del controller attivato');
        $validatedData = $request->validated();
        log::info("dati validati");
        if($this->cliniciModel->updateClinico($validatedData, $userClin))
            return redirect()->action([AdminController::class, 'viewGestioneClinici']);
        else
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'aggiornamento del clinico.');
    }
    #SEZIONE DISTURBI
    public function viewDisturbi()
    {
        Log::info('metodo viewDisturbo attivato');

        $disturbi=$this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi',$disturbi);
    }

    public function storeDisturbo(NewDisturboRequest $request): RedirectResponse {
    

        Log::info('metodo storeDisturbo attivato');
        $validatedData = $request->validated();
/*
        $user = new User([
            'username' => $validatedData['username'],
            'password' => Hash::make('stdpassword'),
            'usertype' => 'A'
        ]);
        $user->save();
        devo capire a cosa serve nell'aggiunta del paziente. credo qui non serva???
        
        */
        $disturbo = new DistMotorio;
        $disturbo->fill($validatedData);
        $disturbo->save();

        return redirect()->action([AdminController::class, 'index']);

    }


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
}
