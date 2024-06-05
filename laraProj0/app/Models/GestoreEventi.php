<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Resources\Episodio;


class GestoreEventi extends Model
{
    use HasFactory;

    public function storeEpisodio($validatedData): bool
    {
        DB::beginTransaction();
        try {
            $episodio = new Episodio();
            $episodio->fill($validatedData);
            $episodio->save();
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio dell\'episodio: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteEpisodio($id): bool
    {
        DB::beginTransaction();
        try {
            $episodio = Episodio::find($id);
            $episodio->delete();
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante la cancellazione dell\'episodio: ' . $e->getMessage());
            return false;
        }
    }

}
