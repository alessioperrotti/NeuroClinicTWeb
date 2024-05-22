<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PazController extends Controller
{
    public function index($paziente): View {
        return view('homePaziente')->with('paziente', $paziente);
    }
}
