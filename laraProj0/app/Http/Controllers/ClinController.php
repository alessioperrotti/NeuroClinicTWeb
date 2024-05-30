<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NewPazienteRequest;
use App\Models\Resources\Paziente;
use App\Models\GestoreClinici;
use App\Models\GestorePazienti;
use App\Models\GestoreCartelleClin;
use App\Models\GestoreTerapie;
use App\Models\GestoreDisturbi;
use App\Http\Requests\UpdateClinicoRequest;


class ClinController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;
    protected $gestDistModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
        $this->gestDistModel = new GestoreDisturbi;
    }

    public function index(): View {
        $user = Auth::user();
        $clinico = $user->clinico;
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

        if ($this->gestPazModel->storePaziente($validatedData)) {

            return redirect()->action([ClinController::class, 'index']);
        }
        else {
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del paziente.');
        }
        
    }

    public function viewPazienti(): View {

        $userClin = Auth::user()->clinico->username;
        $pazienti = $this->gestPazModel->getPazientiByClin($userClin);
        return view('listaPazienti')->with('pazienti', $pazienti);
    }

    public function showCartClinica($userPaz) : View {

        $paziente = Paziente::find($userPaz);
        $episodi = $this->gestCartModel->getEpisodiByPaz($userPaz)->sortByDesc('data');
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
        $farmTer = $this->gestTerModel->getFarmaciFreqByTer($terId);
        $attTer = $this->gestTerModel->getAttivitaFreqByTer($terId);
        return view('modificaTerapia')
                ->with('paziente', $paziente)
                ->with('farmaci', $farmaci)
                ->with('attivita', $attivita)
                ->with('farmTer', $farmTer)
                ->with('attTer', $attTer);
    }

    public function storeTerapia($userPaz) : RedirectResponse {

        $validatedData = $_POST;

        if ($this->gestTerModel->storeTerapia($userPaz, $validatedData)) {
            return redirect()->action([ClinController::class, 'showCartClinica'], ['userPaz' => $userPaz]);
        }
        else {
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio della terapia.');
        }
        
    }

    public function showModDiagnosi($userPaz) : View {

        $paziente = Paziente::find($userPaz);
        $distDiagnosi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        $disturbi = $this->gestDistModel->getDisturbi();
        return view('modificaDiagnosi')
                ->with('paziente', $paziente)
                ->with('distDiagnosi', $distDiagnosi)
                ->with('disturbi', $disturbi);
    }

    public function storeDiagnosi($userPaz) : RedirectResponse {

        $validatedData = $_POST;
        Log::info($validatedData);

        if ($this->gestTerModel->storeDiagnosi($userPaz, $validatedData)) {
            return redirect()->action([ClinController::class, 'showCartClinica'], ['userPaz' => $userPaz]);
        }
        else {
            return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio della diagnosi.');
        }
    }

    public function showModClinico () : View {
            
            $clinico = Auth::user()->clinico;
            return view('aggiornaClinico')
                ->with('clinico', $clinico);
    }

    public function updateClinico(UpdateClinicoRequest  $request) : RedirectResponse
    {
        
        $validatedData = $request->validated();
        $userClin = Auth::user()->clinico->username;
        
        if($this->gestClinModel->updateClinico($validatedData, $userClin))
            return redirect()->action([ClinController::class, 'index']);
        else
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'aggiornamento del clinico.');
    }

    public function showPassChange () : View {
        
        return view('cambiaPwdPaziente');
    }
}
