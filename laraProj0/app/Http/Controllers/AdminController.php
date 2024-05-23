<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestorePazienti;

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
}
