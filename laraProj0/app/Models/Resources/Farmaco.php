<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Terapia;

class Farmaco extends Model
{
    protected $table = 'farmaco';
    public $timestamps = false;
    protected $fillable = ['nome', 'descr'];


    protected $fillable = ['nome', 'descr'];

    public function terapie()
    {
        return $this->hasMany(Terapia::class, 'terapia', 'id');
    }

    
}
