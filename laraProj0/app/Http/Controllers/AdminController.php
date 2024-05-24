<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorePazienti;
use App\Models\Resources\Paziente;

class AdminController extends Controller
{
    protected $adminModel;
    protected $pazienteModel;

    public function __construct() {
        $this->pazienteModel= new GestorePazienti;
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
