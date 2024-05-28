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
    use HasFactory;
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

    public function getFarmaciByTer ($terId) : Collection {

        $terapia = Terapia::with('prescrizioni.farmaco')->findOrFail($terId);
        $farmaci = $terapia->prescrizioni->pluck('farmaco')->unique();
        return $farmaci;
    }

    public function getAttivitaByTer ($terId) : Collection {

        $terapia = Terapia::with('pianificazioni.attivita')->findOrFail($terId);
        $attivita = $terapia->pianificazioni->pluck('attivita')->unique();
        return $attivita;
    }    
    
}
