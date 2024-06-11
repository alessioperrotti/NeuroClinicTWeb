<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Resources\Paziente;
use App\Models\Resources\Messaggio;
use App\Models\User;
use App\Models\GestoreCartelleClin;
use App\Models\GestoreTerapie;
use App\Models\GestoreDistubi;
use App\Models\GestorePazienti;
use App\Models\GestoreClinici;
use App\Models\Resources\Episodio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\NewEventoRequest;
use App\Http\Requests\NewMessaggioRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\GestoreEventi;
use App\Http\Requests\NewPazienteRequest;
use App\Models\GestoreMessaggi;
use App\Models\Resources\Clinico;
use Illuminate\Http\RedirectResponse;
use App\Models\Resources\Disturbo;
use App\Http\Requests\UpdatePazienteRequest;

/*use App\Models\Resources\Attivita;
use App\Models\Resources\Clinico;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\DistMotorio;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;*/



class PazController extends Controller
{
    protected $gestClinModel;
    protected $gestPazModel;
    protected $gestCartModel;
    protected $gestTerModel;
    protected $gestEventModel;
    protected $gestMsgModel;

    public function __construct()
    {
        $this->gestClinModel = new GestoreClinici;
        $this->gestPazModel = new GestorePazienti;
        $this->gestCartModel = new GestoreCartelleClin;
        $this->gestTerModel = new GestoreTerapie;
        $this->gestEventModel = new GestoreEventi;
        $this->gestMsgModel = new GestoreMessaggi;
    }

    public function index(): View
    {
        $user = Auth::user();
        $paziente = $user->paziente;
        if (Hash::check('stdpassword', $user->password)) {  /* se la password è quella di default si mostrerà un alert */
            $changed = false;
        } else {
            $changed = true;
        }


        $messaggiRic = $this->gestMsgModel->getMsgRicevuti(Auth::user()->username);
        $nuoviMsg = 0;

        foreach($messaggiRic as $msg) {
            if(!$msg->letto){
                $nuoviMsg += 1;
            }
        }

        return view('homePaziente')
            ->with('paziente', $paziente)
            ->with('changed', $changed)
            ->with('nuoviMsg', $nuoviMsg);
    }

    public function edit($username): View
    {
        $paziente = Paziente::findOrFail($username);
        return view('aggiornaDatiPaziente')
            ->with('paziente', $paziente)
            ->with('clinico', $paziente->clinico);
    }

    public function update(UpdatePazienteRequest $request, $username): Jsonresponse
    {

        $validatedData = $request->validated();
        $paziente = Paziente::findOrFail($username);
        $riuscito = $this->gestPazModel->updatePaziente($validatedData, $username);
        if (!$riuscito) {
            return response()->json(['error' => 'Errore durante l\'aggiornamento dei dati del paziente.'], 422);
        }
        $paziente->refresh();
        return response()->json(['redirect' => route('homePaziente')]);
    }


    public function showCartClinica(): View
    {

        $paziente = Auth::user()->paziente;
        $paziente->terCambiata = false;
        $paziente->save();
        $userPaz = $paziente->username;
        $episodi = $this->gestCartModel->getEpisodiByPaz($userPaz)->sortByDesc('data');
        $disturbi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        $terapia = $this->gestCartModel->getTerapiaAttivaByPaz($userPaz);
        $terId = $terapia->id;
        $farmaci = $this->gestTerModel->getFarmaciFreqByTer($terId);
        $attivita = $this->gestTerModel->getAttivitaFreqByTer($terId);

        return view('cartellaClinicaPaziente')
            ->with('paziente', $paziente)
            ->with('episodi', $episodi)
            ->with('disturbi', $disturbi)
            ->with('farmaci', $farmaci)
            ->with('attivita', $attivita);
    }

    public function showPassChange(): View
    {
        return view('cambiaPwdPaziente');
    }

    public function showNuovoEpisodio(): View
    {
        $userPaz = Auth::user()->paziente->username;
        $disturbi = $this->gestCartModel->getDisturbiByPaz($userPaz);
        $episodi = $this->gestCartModel->getEpisodiByPaz($userPaz)->sortByDesc('disturbo');
        return view('inserimentoNuovoEvento')
            ->with('disturbi', $disturbi)
            ->with('userPaz', $userPaz)
            ->with('episodi', $episodi);
    }

    public function storeEpisodio(NewEventoRequest $request): JsonResponse
    {

        $validatedData = $request->validated();
        $riuscito = $this->gestEventModel->storeEpisodio($validatedData);

        if ($riuscito) {
            return response()->json(['redirect' => route('homePaziente')]);
        } else {
            return response()->json(['error' => 'Errore durante l\'aggiunta dell\'episodio.'], 422);
        }
    }

    public function eliminaDisturbo($id): RedirectResponse
    {
        if (!$this->gestEventModel->deleteEpisodio($id))
            return redirect()->back()->with('success', 'Episodio eliminato con successo.');
        else
            return redirect()->back()->with('error', 'Errore durante l\'eliminazione del clinico.');
    }

    public function showMessaggi(): View
    {

        $userPaz = Auth::user()->username;
        $messaggiRic = $this->gestMsgModel->getMsgRicevuti($userPaz)->sortByDesc('created_at');
        $messaggiInv = $this->gestMsgModel->getMsgInviati($userPaz)->sortByDesc('created_at');
        $clinico = Clinico::find(Auth::user()->paziente->clinico);

        foreach($messaggiRic as $msg) {
            $messaggio = Messaggio::find($msg->id);
            $messaggio->segnaLetto();
        }
      
        return view('messaggiPaziente')
            ->with('messaggiRic', $messaggiRic)
            ->with('messaggiInv', $messaggiInv)
            ->with('clinico', $clinico);
            
            
    }

    public function sendMessaggio(NewMessaggioRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        if ($this->gestMsgModel->sendMessaggio($validatedData)) {
            return redirect()->action([PazController::class, 'showMessaggi']);
        } else {
            return redirect()->back()->with('error', 'Si è verificato un errore durante l\'invio del messaggio.');
        }
    }

    public function showTerPassate() : View {

        $paziente = Auth::user()->paziente;
        $userPaz = $paziente->username;
        $terapie = $this->gestTerModel->getTerapieByPaz($userPaz)->sortByDesc('data');
        $terIds = $terapie->pluck('id');
        $terAssoc = array();

        foreach($terIds as $terId) {
            $farmaci = $this->gestTerModel->getFarmaciFreqByTer($terId);
            $attivita = $this->gestTerModel->getAttivitaFreqByTer($terId);
            $terAssoc[$terId] = ['farmaci' => $farmaci, 'attivita' => $attivita, 'dataTer' => $terapie->find($terId)->data];
        }

        return view('terapiePassate')
            ->with('paziente', $paziente)
            ->with('terAssoc', $terAssoc);

    }

    public function deleteMessaggio() : RedirectResponse {
        $id = $_POST['msgId'];
        $msg = Messaggio::find($id);
        $msg->eliminatoPaz = true;

        if($msg->eliminatoClin) {  // se è stato eliminato anche dal clinico lo elimino dal db
            $msg->delete();
        }
        else {
            $msg->save();
        }

        return redirect()->action([PazController::class, 'showMessaggi']);
    }
}
