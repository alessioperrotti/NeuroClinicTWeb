<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Resources\Clinico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GestoreClinici extends Model
{
    public function getClinici() : Collection {
        $clinici = Clinico::all();
        return $clinici;
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
}
