<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Faq;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GestoreFaq extends Model
{
    use HasFactory;

    public function getFaqs(): Collection
    {
        $faqs=Faq::all();
        return $faqs;
    }
    public function deleteFaq($id): bool
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return true;
    }
    public function storeFaq($validatedData): bool
    {
        DB::beginTransaction();
        try {
            $faq = new Faq();
            $faq->fill($validatedData);
            $faq->save();
            DB::commit();
            return true;
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio della FAQ: ' . $e->getMessage());
            return false;
        }
    }
    public function updateFaq($validatedData, $id): bool
    {
        DB::beginTransaction();
        try {
            $faq = Faq::findOrFail($id);
            $faq->risposta = $validatedData['risposta'];
            $faq->save();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante l\'aggiornamento della FAQ: ' . $e->getMessage());
            return false;
        }
        return true;
    }
}
