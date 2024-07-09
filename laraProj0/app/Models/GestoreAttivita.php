<?php

namespace App\Models;

use App\Models\Resources\Attivita;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class GestoreAttivita extends Model
{
    use HasFactory;

    public function getAttivita(): Collection
    {
        $attivita = Attivita::all();
        return $attivita;
    }

    public function deleteAttivita($id): Bool
    {

        DB::beginTransaction();
        try {
            $attivita = Attivita::findOrFail($id);
            $attivita->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'eliminazione dell\'attivita: ' . $e->getMessage());
            return false;
        }
    }

    public function storeAttivita($data): Bool
    {   
        DB::beginTransaction($data);
        try {
            $attivita = new Attivita();
            $attivita->fill($data);
            $attivita->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio dell\'attivita: ' . $e->getMessage());
            return false;
        }

    }

    public function updateAttivita($data){
        
        DB::beginTransaction();
        try {
            $id = $data['id'];
            $attivita = Attivita::findOrFail($id);
            $attivita->fill($data);
            $attivita->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento dell\'attivita: ' . $e->getMessage());
            return false;
        }
    }
}

