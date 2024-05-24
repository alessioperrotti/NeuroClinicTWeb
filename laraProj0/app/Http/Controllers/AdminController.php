<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDisturboRequest;
use App\Models\GestoreDisturbi;
use App\Models\Resources\DistMotorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    protected $disturbiModel;

    public function __construct()
    {
        
        #$this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
          
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

        return redirect()->action([AdminController::class, 'viewDisturbi']);

    }

    
    
}
