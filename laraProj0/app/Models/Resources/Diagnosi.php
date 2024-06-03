<?php

namespace App\Models\Resources;

use App\Models\Resources\Paziente;
use App\Models\Resources\DistMotorio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosi extends Model
{
    protected $table = 'diagnosi';
    public $timestamps = false;
    protected $fillable = ['paziente', 'disturbo', 'data'];

    public function paziente()
    {
        return $this->belongsTo(Paziente::class, 'paziente', 'username');
    }

    public function disturbo()
    {
        return $this->belongsTo(DistMotorio::class, 'disturbo', 'id');
    }
}
