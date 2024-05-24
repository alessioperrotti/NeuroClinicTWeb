<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use Illuminate\Database\Eloquent\Collection;

class GestorePazienti extends Model
{
    use HasFactory;

    public function getPazienti(): Collection
    {
        $pazienti=Paziente::all();
        return $pazienti;
    }

    public  function eliminaPaz($username) : bool
    {
        $paziente = Paziente::findOrFail($username);
        $paziente->delete();
        return true;
    }   

}
