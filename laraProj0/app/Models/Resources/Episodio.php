<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Paziente;

class Episodio extends Model
{
    protected $table = 'episodio';
    public $timestamps = false;

    public function paziente()
    {
        return $this->belongsTo(Paziente::class, 'paziente', 'username');
    }

    
    public function disturbo()
    {
        return $this->belongsTo(DistMotorio::class, 'disturbo', 'id');
    }
}
