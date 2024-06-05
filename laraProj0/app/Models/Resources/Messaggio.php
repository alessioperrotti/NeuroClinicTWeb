<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messaggio extends Model
{
    use HasFactory;


    protected $table = 'messaggio';
    public $timestamps = false;
    
    protected $fillable = ['mandante', 'ricevente', 'contenuto'];

}
