<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attivita extends Model
{
    protected $table = 'attivita';
    public $timestamps = false;

    public function terapie()
    {
        return $this->hasMany(Terapia::class, 'terapia', 'id');
    }
}
