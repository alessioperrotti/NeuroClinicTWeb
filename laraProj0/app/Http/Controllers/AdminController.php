<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorePazienti;
use App\Models\Resources\Paziente;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;

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
