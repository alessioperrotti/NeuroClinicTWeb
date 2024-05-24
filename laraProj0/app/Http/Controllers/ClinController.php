<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NewPazienteRequest;
use App\Models\Resources\Paziente;
use App\Models\GestoreClinici;
use App\Models\GestorePazienti;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClinController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
    }

    public function index(): View {
        $user = Auth::user();
        $clinico = $user->clinico;
        Log::info('Accedo a controller clinico');
        return view('homeClinico')->with('clinico', $clinico);
    }

    public function addPaziente(): View {

        $clinici = $this->gestClinModel->getClinici();
        $province = ['AG', 'AL', 'AN', 'AO', 'AR', 'AP', 'AT', 'AV', 'BA', 'BT', 'BL', 'BN', 'BG', 'BI', 'BO',
         'BZ', 'BS', 'BR', 'CA', 'CL', 'CB', 'CI', 'CE', 'CT', 'CZ', 'CH', 'CO', 'CS', 'CR', 'KR', 'CN', 'EN',
          'FM', 'FE', 'FI', 'FG', 'FC', 'FR', 'GE', 'GO', 'GR', 'IM', 'IS', 'SP', 'AQ', 'LT', 'LE', 'LC', 'LI',
           'LO', 'LU', 'MC', 'MN', 'MS', 'MT', 'ME', 'MI', 'MO', 'MB', 'NA', 'NO', 'NU', 'OR', 'PD', 'PA', 'PR',
            'PV', 'PG', 'PU', 'PE', 'PC', 'PI', 'PT', 'PN', 'PZ', 'PO', 'RG', 'RA', 'RC', 'RE', 'RI', 'RN', 'RM',
             'RO', 'SA', 'SS', 'SV', 'SI', 'SR', 'SO', 'SU', 'TA', 'TE', 'TR', 'TO', 'TP', 'TN', 'TV', 'TS', 'UD',
              'VA', 'VE', 'VB', 'VC', 'VR', 'VV', 'VI', 'VT'];

        return view('nuovoPaziente')->with('province', $province)->with('clinici', $clinici);
    }

    public function storePaziente(NewPazienteRequest $request) : RedirectResponse {

        $validatedData = $request->validated();
        $user = new User([
            'username' => $validatedData['username'],
            'password' => Hash::make('stdpassword'),
            'usertype' => 'P'
        ]);
        $user->save();
        $paziente = New Paziente;
        $paziente->fill($validatedData);
        $paziente->save();
        

        return redirect()->action([ClinController::class, 'index']);
    }

    public function viewPazienti(): View {
        
        $pazienti = $this->gestPazModel->getPazienti();
        return view('listaPazienti')->with('pazienti', $pazienti);
    }

    public function showCartClinica($userPaz) : View {
        $paziente = Paziente::find($userPaz);
        // gestire reperimento farmaci, attività ed episodi
        return view('cartellaClin2')->with('paziente', $paziente);
    }
}
