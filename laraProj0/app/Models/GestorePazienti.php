<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Resources\User;
use App\Models\Resources\Terapia;

class GestorePazienti extends Model
{
    use HasFactory;

    public function getPazienti(): Collection
    {
        $pazienti=Paziente::all();
        return $pazienti;
    }

    public function getPazientiByClin($userClin): Collection
    {
        $pazienti = Paziente::where('clinico', $userClin)->get();
        return $pazienti;
    }

    public  function eliminaPaz($username) : bool
    {
        $paziente = Paziente::findOrFail($username);
        $paziente->delete();
        return true;
    }
    
    public function storePaziente($validatedData) : bool {

        DB::beginTransaction();
        try {
            $user = new User([
                'username' => $validatedData['username'],
                'password' => Hash::make('stdpassword'),
                'usertype' => 'P'
            ]);
            $user->save();
            $paziente = New Paziente;
            $paziente->fill($validatedData);
            $paziente->terCambiata = false;
            $paziente->save();
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
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
    
        return round($media, 2);
    }
    public function getNumeroCambiTerapia($username) {
        $numeroTerapie = Terapia::where('paziente', $username)->count();
        $numeroCambiTerapia = $numeroTerapie - 1;
        return $numeroCambiTerapia;
    }

}
