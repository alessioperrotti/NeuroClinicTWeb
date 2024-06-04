<?php

namespace App\Models;

use App\Models\Resources\DistMotorio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GestoreDisturbi extends Model
{

    public function getDisturbi():Collection {
        $disturbi = DistMotorio::all();
        return $disturbi;
    }
    public function getDisturbo($id):DistMotorio {
        $disturbo = DistMotorio::findOrFail($id);
        return $disturbo;
    }
    

    public function deleteDisturbo($data): Bool 
    {
        
        DB::beginTransaction();
        try {
            $id = $data['idDel'];
            $disturbo = DistMotorio::findOrFail($id);
            $disturbo->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'eliminazione del disturbo: ' . $e->getMessage());
            return false;
        }

    }

    public function storeDisturbo($data){
        DB::beginTransaction();
        try {
            $disturbo = new DistMotorio();
            $disturbo->fill($data);
            $disturbo->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio del disturbo: ' . $e->getMessage());
            return false;
        }

    }

    public function updateDisturbo($data){
        
        DB::beginTransaction();
        try {
            $id = $data['id'];
            $disturbo = DistMotorio::findOrFail($id);
            $disturbo->nome = $data['nome'];
            $disturbo->categoria = $data['categoria'];
            $disturbo->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento del disturbo: ' . $e->getMessage());
            return false;
        }
    }
    

    
}

