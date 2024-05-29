<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Episodio;

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

    public function mediaDisturbiMotoriPerPaziente() {
        $numeroPazienti = Paziente::count();
    
        if ($numeroPazienti == 0) {
            return 0;
        }
    
        $numeroDisturbiTotali = 0;
    
        $pazienti = Paziente::all();
        foreach ($pazienti as $paziente) {
            $disturbiUnici = $paziente->episodi()->with('disturbo')->get()->unique('disturbo.id')->count();
            $numeroDisturbiTotali += $disturbiUnici;
        }
    
        $media = $numeroDisturbiTotali / $numeroPazienti;
    
        return $media;
    }

}
