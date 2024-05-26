<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['domanda', 'risposta'];
    
    public $timestamps = false; // Disabilita i timestamp automatici


}
