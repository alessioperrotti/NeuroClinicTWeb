<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class PazController extends Controller
{
    public function index(): View {
        Log::info('Accedo al controller');
        return view('homePaziente');
    }

}
