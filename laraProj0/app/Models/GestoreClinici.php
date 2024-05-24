<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Clinico;

class GestoreClinici extends Model
{
    public function getClinici() : Collection {
        $clinici = Clinico::all();
        return $clinici;
    }
}
