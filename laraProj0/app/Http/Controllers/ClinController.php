<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NewPazienteRequest;
use App\Http\Requests\NewTerapiaRequest;
use App\Models\Resources\Paziente;
use App\Models\GestoreClinici;
use App\Models\GestorePazienti;
use App\Models\GestoreCartelleClin;
use App\Models\GestoreTerapie;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Attivita;
use App\Models\Resources\Prescrizione;
use App\Models\Resources\Pianificazione;
use App\Models\Resources\Terapia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClinController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
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

        // spostare logica nel model
        DB::beginTransaction();
        try {
            $user = new User([
                'username' => $validatedData['username'],
                'password' => Hash::make('stdpassword'),
                'usertype' => 'P'
            ]);
            $user->save();
            $paziente = New Paziente;
            $paziente->fill($validatedData);
            $paziente->save();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
        }
        
        return redirect()->action([ClinController::class, 'index']);
    }

    public function viewPazienti(): View {

        $userClin = Auth::user()->clinico->username;
        $pazienti = $this->gestPazModel->getPazientiByClin($userClin);
        return view('listaPazienti')->with('pazienti', $pazienti);
    }

    public function showCartClinica($userPaz) : View {

        $paziente = Paziente::find($userPaz);
        $episodi = $this->gestCartModel->getEpisodiByPaz($userPaz);
        $disturbi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        $terapia = $this->gestCartModel->getTerapiaAttivaByPaz($userPaz);
        $terId = $terapia->id;
        $farmaci = $this->gestTerModel->getFarmaciFreqByTer($terId);
        $attivita = $this->gestTerModel->getAttivitaFreqByTer($terId);

        return view('cartellaClin2')
                ->with('paziente', $paziente)
                ->with('episodi', $episodi)
                ->with('disturbi', $disturbi)
                ->with('farmaci', $farmaci)
                ->with('attivita', $attivita);
    }

    public function showModTerapia($userPaz) : View {

        $paziente = Paziente::find($userPaz);
        $farmaci = $this->gestTerModel->getFarmaci();
        $attivita = $this->gestTerModel->getAttivita();
        $terapia = $this->gestCartModel->getTerapiaAttivaByPaz($userPaz);
        $terId = $terapia->id;
        $farmTer = $this->gestTerModel->getFarmaciByTer($terId);
        $attTer = $this->gestTerModel->getAttivitaByTer($terId);
        return view('modificaTerapia')
                ->with('paziente', $paziente)
                ->with('farmaci', $farmaci)
                ->with('attivita', $attivita)
                ->with('farmTer', $farmTer)
                ->with('attTer', $attTer);
    }

    public function storeTerapia(NewTerapiaRequest $request, $userPaz) : RedirectResponse {

        $validatedData = $request->validated();
        $data = Carbon::now()->toDateString();
        $terapia = new Terapia([
            'data' => $data,
            'paziente' => $userPaz
        ]);

        $terapia->save();

        foreach($validatedData['farmaco'] as $item){

            $farmaco = Farmaco::where('nome', $item)->first();
            $campoVolte = 'nvolteF'.$farmaco->id;
            $campoPeriodo = 'periodoF'.$farmaco->id;
            $freq = $validatedData[$campoVolte] . " " . $validatedData[$campoPeriodo];

            $prescrizione = new Prescrizione([

                'terapia' => $terapia->id,
                'farmaco' => $farmaco->id,
                'freq' => $freq
            ]);
        }
        
        foreach($validatedData['attivita'] as $item){

            $attivita = Attivita::where('nome', $item)->first();
            $campoVolte = 'nvolteA'.$attivita->id;
            $campoPeriodo = 'periodoA'.$attivita->id;
            $freq = $validatedData[$campoVolte] . " " . $validatedData[$campoPeriodo];

            $pianificazione = new Pianificazione([

                'terapia' => $terapia->id,
                'attivita' => $item->id,
                'freq' => $freq
            ]);
        }
        
        
        return redirect()->back();

    }
}
