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
    public function eliminaFaq($id): bool
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
        } 
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Errore durante il salvataggio della FAQ: ' . $e->getMessage());
            return false;
        }
        return true;
    }
}
