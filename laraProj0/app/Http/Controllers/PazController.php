<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PazController extends Controller
{
    public function index(): View {
        Log::info('Accedo al controller');
        $user = Auth::user();
        $paziente = $user->paziente;
        return view('homePaziente')->with('paziente', $paziente);
    }

}
