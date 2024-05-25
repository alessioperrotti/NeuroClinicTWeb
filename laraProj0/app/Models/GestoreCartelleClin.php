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
        return new Collection($disturbi);
    }

    public function getTerapiaAttivaByPaz($userPaz): Terapia {

        $terapia = Terapia::where('paziente', $userPaz)->orderBy('data', 'desc')->first();
        return $terapia;
        
    }
}
