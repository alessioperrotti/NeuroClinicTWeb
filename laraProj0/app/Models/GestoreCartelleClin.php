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
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GestoreCartelleClin extends Model
{
    use HasFactory;

    public function getEpisodiByPaz($userPaz): Collection {
        
        $paziente = Paziente::with('episodi')->find($userPaz);
        $episodi = new Collection;
        foreach($paziente->episodi as $episodio) {
            $dist = DistMotorio::find($episodio->disturbo);
            $episodio->disturbo = $dist;
            $episodi->add($episodio);
        }
        return $episodi;
    }

    public function getDisturbiByPaz($userPaz): Collection {

        $paziente = Paziente::with('diagnosi.disturbo')->findOrFail($userPaz);
        $latestDiagnosiDate = $paziente->diagnosi->max('data');
        $diagnosi = $paziente->diagnosi->where('data', $latestDiagnosiDate);
        $disturbi = new Collection;
        foreach($diagnosi as $diagn) {
            $dist = DistMotorio::find($diagn->disturbo);
            $disturbi->add($dist);
        }
        return $disturbi;
    }

    public function getTerapiaAttivaByPaz($userPaz): Terapia {

        $terapia = Terapia::where('paziente', $userPaz)->orderBy('data', 'desc')->first();

        if($terapia != null) {
            return $terapia;
        }
        else {
            $data = Carbon::now()->toDateTimeString();
            $terapia = new Terapia([
                'data' => $data,
                'paziente' => $userPaz
            ]);
            $terapia->save();
            return $terapia;
        }
        
    }
}
