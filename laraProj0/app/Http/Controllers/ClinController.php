<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewMessaggioRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NewPazienteRequest;
use App\Models\Resources\Paziente;
use App\Models\Resources\Messaggio;
use App\Models\GestoreClinici;
use App\Models\GestorePazienti;
use App\Models\GestoreCartelleClin;
use App\Models\GestoreTerapie;
use App\Models\GestoreDisturbi;
use App\Models\GestoreMessaggi;
use App\Http\Requests\UpdateClinicoRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;


class ClinController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;
    protected $gestDistModel;
    protected $gestMsgModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
        $this->gestDistModel = new GestoreDisturbi;
        $this->gestMsgModel = new GestoreMessaggi;

    }

    public function index(): View {
        $user = Auth::user();
        $clinico = $user->clinico;
        if (Hash::check('stdpassword', $user->password)) {  /* se la password è quella di 
                                                                default si mostrerà un alert */
            $changed = false;
        } 
        else {
            $changed = true;
        }

        $messaggiRic = $this->gestMsgModel->getMsgRicevuti(Auth::user()->username);
        $nuoviMsg = 0;

        foreach($messaggiRic as $msg) {
            if(!$msg->letto){
                $nuoviMsg += 1;
            }
        }


        return view('homeClinico')
            ->with('clinico', $clinico)
            ->with('changed', $changed)
            ->with('nuoviMsg', $nuoviMsg);
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

    public function storePaziente(NewPazienteRequest $request) : JsonResponse {

        $validatedData = $request->validated();

        if ($this->gestPazModel->storePaziente($validatedData)) {

            //return redirect()->action([ClinController::class, 'index']);
            return response()->json(['redirect' => route('homeClinico')]);
        }
        else {
            //return redirect()->back()->with('error', 'Si è verificato un errore durante il salvataggio del paziente.');
            return response()->json(['error' => 'Errore durante l\'aggiunta del paziente.'], 422);
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
        $terapia = $this->gestTerModel->getTerapiaAttivaByPaz($userPaz);
        $terId = $terapia->id;
        $farmaci = $this->gestTerModel->getFarmaciFreqByTer($terId);
        $attivita = $this->gestTerModel->getAttivitaFreqByTer($terId);

        // se non ci sono disturbi, li setto a null piuttosto che mandare una collection vuota
        if ($disturbi->every(function ($value) {
            return is_null($value);
        })) {
            $disturbi = null;
        }

        $disturbiSel = new Collection;  /* disturbi per la select di filtro episodi (sono i disturbi 
                                                            associati agli episodi del paziente) */

        if(!$episodi->isEmpty()) {
            foreach($episodi as $episodio) {
                $disturbo = $episodio->disturbo;
                $disturbiSel->add($disturbo);
            }

            $disturbiSel = $disturbiSel->unique('id');
        }

        return view('cartellaClin2')
                ->with('paziente', $paziente)
                ->with('episodi', $episodi)
                ->with('disturbi', $disturbi)
                ->with('farmaci', $farmaci)
                ->with('attivita', $attivita)
                ->with('disturbiSel', $disturbiSel);
    }

    public function showModTerapia($userPaz) : View {

        $paziente = Paziente::find($userPaz);
        $farmaci = $this->gestTerModel->getFarmaci();
        $attivita = $this->gestTerModel->getAttivita();
        $terapia = $this->gestTerModel->getTerapiaAttivaByPaz($userPaz);
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

        $validatedData = $_POST; //avrò i value delle checkbox checked, quindi gli id dei disturbi diagnosticati

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

    public function updateClinico(UpdateClinicoRequest  $request) : JsonResponse {
        
        $validatedData = $request->validated();
        $userClin = Auth::user()->clinico->username;
        
        if($this->gestClinModel->updateClinico($validatedData, $userClin)) {
            return response()->json(['redirect' => route('homeClinico')]);
        }
        else {
            return response()->json(['error' => 'Errore durante l\'aggiunta del paziente.'], 422);
        }
    }

    public function showPassChange () : View {
        
        return view('cambiaPwdClinico');
    }

    public function showMessaggi() : View {

        $userClin = Auth::user()->username;
        $messaggiRic = $this->gestMsgModel->getMsgRicevuti($userClin)->sortByDesc('created_at');
        $messaggiInv = $this->gestMsgModel->getMsgInviati($userClin)->sortByDesc('created_at');
        $pazienti = $this->gestClinModel->getPazientiByClin($userClin);

        foreach($messaggiRic as $msg) {
            $messaggio = Messaggio::find($msg->id);
            $messaggio->segnaLetto();
        }
        
        return view('messaggiClinico')
            ->with('messaggiRic', $messaggiRic)
            ->with('messaggiInv', $messaggiInv)
            ->with('pazienti', $pazienti);
        
            
    }

    public function sendMessaggio(NewMessaggioRequest $request) : RedirectResponse {
        $validatedData = $request->validated();
        
        if ($this->gestMsgModel->sendMessaggio($validatedData)) {
            return redirect()->action([ClinController::class, 'showMessaggi']);
        }
        else {
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'invio del messaggio.');
        }
    }

    public function deleteMessaggio($msgId) : RedirectResponse {
        
        $msg = Messaggio::find($msgId);
        $msg->eliminatoClin = true;

        if($msg->eliminatoPaz) {  // se è stato eliminato anche dal paziente lo elimino dal db
            $msg->delete();
        }
        else {
            $msg->save();
        }

        return redirect()->action([ClinController::class, 'showMessaggi']);
    }
}
