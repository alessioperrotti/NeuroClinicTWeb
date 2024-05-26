<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Attivita;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;
use Illuminate\Database\Eloquent\Collection;

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

    public function getFarmaciByTer ($terId) : array {

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

    public function getAttivitaByTer ($terId) : array {

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
    
}
