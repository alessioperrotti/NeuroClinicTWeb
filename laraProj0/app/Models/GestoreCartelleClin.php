<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use App\Models\Resources\Episodio;
use App\Models\Resources\Diagnosi;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Terapia;

class GestoreCartelleClin extends Model
{
    use HasFactory;

    public function getEpisodiByPaz($userPaz): Collection {
        
        $paziente = Paziente::find($userPaz);
        return $paziente->episodi;
    }

    public function getDisturbiByPaz($userPaz): Collection {

        $paziente = Paziente::with('diagnosi.disturbo')->findOrFail($userPaz);
        $disturbi = $paziente->diagnosi->pluck('disturbo')->unique();
        return $disturbi;
    }

    public function getTerapiaAttivaByPaz($userPaz): Terapia {

        $paziente = Paziente::find($userPaz);
        $terapiaAtt = $paziente->terapie->orderBy('data', 'desc')->first(); // estraggo la terapia con data più recente
        return $terapiaAtt;
    }
}
