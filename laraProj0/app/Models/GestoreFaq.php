<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Faq;
use Illuminate\Database\Eloquent\Collection;

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
}
