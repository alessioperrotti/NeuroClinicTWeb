<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDisturboRequest;
use App\Http\Requests\UpdateDisturboRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GestoreDisturbi;
use App\Models\GestoreFarmaci;
use App\Models\GestoreTerapie;
use App\Models\Resources\DistMotorio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    protected $disturbiModel;
    protected $farmaciModel;
    protected $terapieModel;
    protected $pazienti;


    public function __construct()
    {

        $this->middleware('can:isAdmin');
        $this->disturbiModel = new GestoreDisturbi();
        $this->farmaciModel = new GestoreFarmaci();
        $this->terapieModel = new GestoreTerapie();
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
        $disturbi = $this->disturbiModel->getDisturbi();
        return view('gestioneDisturbi')->with('disturbi', $disturbi);
    }


    public function storeDisturbo(NewDisturboRequest $request): RedirectResponse
    {


        Log::info('metodo storeDisturbo attivato');
        $validatedData = $request->validated();


        DB::beginTransaction();
        try {
            $disturbo = new DistMotorio();
            $disturbo->fill($validatedData);
            $disturbo->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio del disturbo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del disturbo.');
        }


        return redirect()->route('gestioneDisturbi');
    }

    public function deleteDisturbo(Request $request)
    {
        $validated = $request->validated([
            'idDel' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $id = $validated['idDel'];
            $this->disturbiModel->deleteDisturbo($id);
            $this->disturbiModel->getDisturbi();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'eliminazione del disturbo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del disturbo.');
        }
        
        return redirect()->route('gestioneDisturbi');
    }


    public function updateDisturbo(UpdateDisturboRequest $request)
    {
        $validated = $request->validated();
       
        DB::beginTransaction();
        try {
            $id = $validated['idMod'];
            $disturbo = DistMotorio::findOrFail($id);
            $disturbo->nome = $validated['nomeMod'];
            $disturbo->categoria = $validated['categoriaMod'];
            $disturbo->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento del disturbo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'aggiornamento del disturbo.');
        }


        return redirect()->route('gestioneDisturbi');
    }


    public function viewTerapie()
    {
    }
}
