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
        return view('listaPaz')->with('pazienti',$pazienti);
    }

    public function eliminaPaziente($username)
    {
        $paziente = Paziente::findOrFail($username);
        $paziente->delete();
        $pazienti=$this->pazienteModel->getPazienti();

        return view('listaPaz', ['pazienti', $pazienti]);
    }
}
