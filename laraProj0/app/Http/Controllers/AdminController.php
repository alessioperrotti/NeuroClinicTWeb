<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorePazienti;
use App\Models\Resources\Paziente;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\GestoreFaq;
use App\Http\Requests\NewFaqRequest;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected $adminModel;
    protected $pazienteModel;
    protected $disturbiModel;

    public function __construct()
    {
        
        #$this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
        $this->pazienteModel= new GestorePazienti;
        $this->faqModel= new GestoreFaq;
          
    }

    public function index()
    {
        $user = Auth::user();
        $admin = $user->paziente;
        return view('homeAdmin'); 
    }

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
    public function storeFaq(NewFaqRequest $request) : RedirectResponse {

        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            $faq = New Faq;
            $faq->fill($validatedData);
            $faq->save();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
        }
        
        return redirect()->action([AdminController::class, 'viewGestioneFaq']);
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
        $pazienti=$this->pazienteModel->getPazienti();
        #return view('listaPaz')->with('pazienti',$pazienti);
        return response()
        ->view('listaPaz', ['pazienti' => $pazienti]);
        
    } 

    public function eliminaPaziente($username)
    {
        $this->pazienteModel->eliminaPaz($username);
        $pazienti = $this->pazienteModel->getPazienti();  #non funziona se chiamo $this->mostraPazienti(); 
        return redirect()->route('listaPaz');   
    }
}
