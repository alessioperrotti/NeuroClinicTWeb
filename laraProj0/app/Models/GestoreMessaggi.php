<?php

namespace App\Models;

use App\Models\Resources\Messaggio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GestoreMessaggi extends Model
{
    use HasFactory;

    public function getMessaggi($mandante, $ricevente){
        $messaggi = Messaggio::where('mandante', $mandante)->where('ricevente', $ricevente)->get();
        return $messaggi;
    }

    public function getConversazione($data){
        $messaggi = $this->getMessaggi($data['mandante'], $data['ricevente']);
        $messaggi = $messaggi->merge($this->getMessaggi($data['ricevente'], $data['mandante']));
        $messaggi = $messaggi->sortBy('updated_at');
        Log::info($messaggi);
        return $messaggi;
    }

    public function sendMessaggio($data)
    {
        DB::beginTransaction();
        try{
            $messaggio = new Messaggio();
            $messaggio->fill($data);
            $messaggio->letto = false;
            $messaggio->updated_at = date('Y-m-d H:i:s');
            $messaggio->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'invio del messaggio: ' . $e->getMessage());
            return false;
        }
       
    }

    

    public function readMessaggio($id){
        $messaggio = Messaggio::findOrFail($id);
        $messaggio->letto = true;
        $messaggio->save();
    }




}
