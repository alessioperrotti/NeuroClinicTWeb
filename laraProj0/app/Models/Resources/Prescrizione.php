<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Farmaco;
use App\Models\Resources\Terapia;

class Prescrizione extends Model
{
    protected $table = 'prescrizione';
    public $timestamps = false;

    protected $fillable = ['freq', 'terapia', 'farmaco'];

    public function farmaco()
    {
        return $this->belongsTo(Farmaco::class, 'farmaco', 'id');
    }

    public function terapia()
    {
        return $this->belongsTo(Terapia::class, 'terapia', 'id');
    }
}
