<?php

namespace App\Models;

use App\Models\Resources\Farmaco;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Bool_;

class GestoreFarmaci extends Model
{
    use HasFactory;

    public function getFarmaci(): Collection
    {
        $farmaci = Farmaco::all();
        return $farmaci;
    }

    public function deleteFarmaco($idFarm): Bool
    {

        DB::beginTransaction();
        try {
            $farmaco = Farmaco::findOrFail($idFarm);
            $farmaco->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'eliminazione del farmaco: ' . $e->getMessage());
            return false;
        }
    }

    public function storeFarmaco($data): Bool
    {   
        DB::beginTransaction($data);
        try {
            $farmaco = new Farmaco();
            $farmaco->fill($data);
            $farmaco->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio del farmaco: ' . $e->getMessage());
            return false;
        }
    }

    public function updateFarmaco($data){
        
        DB::beginTransaction();
        try {
            $id = $data['id'];
            $farmaco = Farmaco::findOrFail($id);
            $farmaco->nome = $data['nome'];
            $farmaco->descr = $data['descr'];
            $farmaco->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento del farmaco: ' . $e->getMessage());
            return false;
        }
    }



}
