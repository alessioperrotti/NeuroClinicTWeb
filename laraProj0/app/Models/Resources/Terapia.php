<?php

namespace App\Models\Resources;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Prescrizione;
use App\Models\Resources\Pianificazione;

class Terapia extends Model
{
    protected $table = 'terapia';
    public $timestamps = false;

    protected $fillable = ['data', 'paziente'];

    public function prescrizioni()
    {
        return $this->hasMany(Prescrizione::class, 'terapia', 'id');
    }

    public function pianificazioni()
    {
        return $this->hasMany(Pianificazione::class, 'terapia', 'id');
    }

    public function paziente()
    {
        return $this->belongsTo(Paziente::class, 'paziente', 'username');
    }
}
