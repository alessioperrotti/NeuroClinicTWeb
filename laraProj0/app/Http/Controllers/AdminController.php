<?php

namespace App\Http\Controllers;

use App\Models\GestoreDisturbi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $disturbiModel;

    public function __construct()
    {
        
        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
          
    }

    public function index()
    {
        $user = Auth::user();
        $admin = $user->paziente;
        return view('homeAdmin'); 
    }


    public function mostraDisturbi()
    {
        $disturbi=$this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi',$disturbi);
    }

    
}
