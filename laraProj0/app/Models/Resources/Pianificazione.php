<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Attivita;
use App\Models\Resources\Terapia;

class Pianificazione extends Model
{
    protected $table = 'pianificazione';
    public $timestamps = false;

    public function attivita()
    {
        return $this->belongsTo(Attivita::class, 'attivita', 'id');
    }

    public function terapia()
    {
        return $this->belongsTo(Terapia::class, 'terapia', 'id');
    }
}
