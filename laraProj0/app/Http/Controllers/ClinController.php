<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClinController extends Controller
{
    public function index(): View {
        $user = Auth::user();
        $clinico = $user->clinico;
        Log::info('Accedo a controller clinico');
        return view('homeClinico')->with('clinico', $clinico);
    }
}
