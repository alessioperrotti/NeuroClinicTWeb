<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use App\Models\Resources\Episodio;
use App\Models\Resources\Diagnosi;
use App\Models\Resources\DistMotorio;
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
        $disturbi = new Collection;
        $diagnosi = $paziente->diagnosi;
        //dd($diagnosi);
        foreach($diagnosi as $diagn) {
            $dist = DistMotorio::find($diagn->disturbo);
            $disturbi->add($dist);
        }
        return $disturbi;
    }

    public function getTerapiaAttivaByPaz($userPaz): Terapia {

        $terapia = Terapia::where('paziente', $userPaz)->orderBy('data', 'desc')->first();
        return $terapia;
        
    }
}
