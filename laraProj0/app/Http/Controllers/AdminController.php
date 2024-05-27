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
use App\Models\Resources\Clinico;
use App\Http\Requests\NewFaqRequest;
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
        $this->faqModel->eliminaFaq($id);
        return redirect()->route('gestioneFaq');
    }
    public function storeFaq(NewFaqRequest $request) : RedirectResponse 
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            $faq = new Faq();
            $faq->fill($validatedData);
            $faq->save();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio della FAQ: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio della FAQ.');
        }
        
        return redirect()->action([AdminController::class, 'viewGestioneFaq'])->with('success', 'FAQ aggiunta con successo.');
    }
    public function updateFaq(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'risposta' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            $faq = Faq::findOrFail($id);
            $faq->risposta = $validatedData['risposta'];
            $faq->save();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento della FAQ: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'aggiornamento della FAQ.');
        }
        
        return redirect()->action([AdminController::class, 'viewGestioneFaq'])->with('success', 'FAQ aggiornata con successo.');
    }

    #SEZIONE CLINICI
    public function viewGestioneClinici()
    {
        $clinici=$this->cliniciModel->getClinici();
        return view('gestioneClinici')->with('clinici',$clinici); 
    }

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
}
