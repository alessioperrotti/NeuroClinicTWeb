<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Clinico;
use App\Models\Resources\Paziente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GestoreClinici extends Model
{
    public function getClinici() : Collection {
        $clinici = Clinico::all();
        return $clinici;
    }
    public function deleteClinico($id) : bool {
        DB::beginTransaction();
        try {
            $clinico = Clinico::findOrFail($id);
            $clinico->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'eliminazione del clinico: ' . $e->getMessage());
            return false;   
        }
        return true;
    }
    public function storeClinico($validatedData): bool
    {
        DB::beginTransaction();
        try{
            Log::info('Sto salvando il clinico');
            $user = new User([
                'username' => $validatedData['username'],
                'password' => Hash::make('stdpassword'),
                'usertype' => 'C'
            ]);
            $user->save();
            log::info('Utente salvato');
            $clinico = New Clinico;
            $clinico->fill($validatedData);
            $clinico->save();
            log::info('Clinico salvato');
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio del clinico: ' . $e->getMessage());
            return false;
        }
        return true;
    }
    public function getClinico($userClin) {
        $clinico = Clinico::findOrFail($userClin);
        return $clinico;
    }
    public function updateClinico($validatedData, $userClin): bool {
        DB::beginTransaction();
        try {
            $clinico = Clinico::findOrFail($userClin);
            $clinico->fill($validatedData);
            $clinico->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento del clinico: ' . $e->getMessage());
            return false;
        }
        return true;
    }
    public function mediaPazientiPerClinico(){
        $numeroClinici = Clinico::count();
        $numeroPazienti = Paziente::count();
    
        if ($numeroClinici == 0) {
            return 0;
        }
    
        $media = $numeroPazienti / $numeroClinici;
        return $media;
    }
}
