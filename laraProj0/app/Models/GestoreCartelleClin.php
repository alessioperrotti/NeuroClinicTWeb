<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use App\Models\Resources\Episodio;
use Illuminate\Database\Eloquent\Collection;

class GestoreCartelleClin extends Model
{
    use HasFactory;

    public function getEpisodiByPaz($userPaz): Collection {
        
        $paziente = Paziente::find($userPaz);
        return $paziente->episodi;
    }

    public function getDisturbiByPaz($userPaz): Collection {

        $paziente = Paziente::find($userPaz);
    }
}
