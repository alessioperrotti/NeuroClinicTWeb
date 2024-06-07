<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Attivita;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Resources\Prescrizione;
use App\Models\Resources\Pianificazione;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\Paziente;
use Illuminate\Support\Facades\Log;

class GestoreTerapie extends Model
{
    protected $farmModel;
    protected $attModel;

    public function __construct(){

        $this->farmModel = new Farmaco;
        $this->attModel = new Attivita;
    }

    public function getFarmaci(): Collection {
        $farmaci = Farmaco::all();
        return $farmaci;
    }

    public function getAttivita(): Collection {
        $attivita = Attivita::all();
        return $attivita;
    }

    public function getFarmaciFreqByTer ($terId) : array {  // restituisce farmaci con frequenza

        $terapia = Terapia::with('prescrizioni.farmaco')->findOrFail($terId);
        $farmaci = [];
        $prescrizioni = $terapia->prescrizioni;
        foreach($prescrizioni as $presc){
            $farm = Farmaco::findOrFail($presc->farmaco);
            $farmaci[] = [
                'farmaco' => $farm,
                'freq' => $presc->freq
            ];
        }
        return $farmaci; 
    }

    public function getAttivitaFreqByTer ($terId) : array {  // restituisce attività con frequenza

        $terapia = Terapia::with('pianificazioni.attivita')->findOrFail($terId);
        $attivita = [];
        $pianificazioni = $terapia->pianificazioni;
        foreach($pianificazioni as $pian){
            $att = Attivita::findOrFail($pian->attivita);
            $attivita[] = [
                'attivita' => $att,
                'freq' => $pian->freq
            ];
        }
        return $attivita;
    }

    public function storeTerapia ($userPaz, $validatedData) : bool {

        $data = Carbon::now()->toDateTimeString(); //prende la data corrente

        DB::beginTransaction();
        try{
            $terapia = new Terapia([
                'data' => $data,
                'paziente' => $userPaz
            ]);

            $terapia->save();
            Paziente::where('username', $userPaz)->update(['terCambiata' => true]); // setta terCambiata a true

            if(isset($validatedData['farmaco'])){
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
                    $prescrizione->save();
                }
            }
            
            if(isset($validatedData['attivita'])){
                foreach($validatedData['attivita'] as $item){

                    $attivita = Attivita::where('nome', $item)->first();
                    $campoVolte = 'nvolteA'.$attivita->id;
                    $campoPeriodo = 'periodoA'.$attivita->id;
                    $freq = $validatedData[$campoVolte] . " " . $validatedData[$campoPeriodo];

                    $pianificazione = new Pianificazione([

                        'terapia' => $terapia->id,
                        'attivita' => $attivita->id,
                        'freq' => $freq
                    ]);
                    $pianificazione->save();
                }
            }
            
            DB::commit();
            return true;
        }
            catch(\Exception $e) {
                DB::rollBack();
                return false;
        }
    }

    public function storeDiagnosi ($userPaz, $validatedData) {
            
            $data = Carbon::now()->toDateTimeString(); //prende la data corrente
    
            DB::beginTransaction();
            try{
                foreach($validatedData['disturbo'] as $item){
                    $diagnosi = new Diagnosi([
                        'data' => $data,
                        'paziente' => $userPaz,
                        'disturbo' => $item
                    ]);
                    $diagnosi->save();
                }
                
                DB::commit();
                return true;
            }
                catch(\Exception $e) {
                    DB::rollBack();
                    return false;
            }
    }

    public function getTerapieByPaz($userPaz) : Collection {
        
        $terapie = Terapia::where('paziente', $userPaz)->get();
        return $terapie;
    }
    
}
