<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Resources\Terapia;
use App\Models\GestoreMessaggi;

class GestorePazienti extends Model
{
    protected $gestMsgModel;

    public function __construct()
    {
        $this->gestMsgModel = new GestoreMessaggi;
    }

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

        $this->gestMsgModel->deleteMessaggiByUser($username);

        $paziente = Paziente::findOrFail($username);
        $user = User::findOrFail($username);
        $paziente->delete();
        $user->delete();

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
    
    public function updatePaziente($validatedData, $username) : bool {
        DB::beginTransaction();
        try {
            $paziente = Paziente::findOrFail($username);
            $paziente->fill($validatedData);
            $paziente->save();
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function mediaEventiDiDisturbi($paziente, $disturbi)
    {
        // Conta il numero di disturbi
        $numeroDisturbi = $disturbi->count();
        // estraggo id
        $disturboIds = $disturbi->pluck('id');
        
        // Conta il numero di episodi relativi ai disturbi "attivi"
        $numeroEpisodi = $paziente->episodi()->whereIn('disturbo', $disturboIds)->count();
        
        if ($numeroDisturbi > 0) {
            $mediaEventiDiDisturbi = $numeroEpisodi / $numeroDisturbi;
        } else {
            $mediaEventiDiDisturbi = 0; 
        }
        
        return round($mediaEventiDiDisturbi, 2);
    }

    public function getNumeroCambiTerapia($username) {
        $numeroTerapie = Terapia::where('paziente', $username)->count();
        $numeroCambiTerapia = $numeroTerapie - 1;
        return $numeroCambiTerapia;
    }
    

}
