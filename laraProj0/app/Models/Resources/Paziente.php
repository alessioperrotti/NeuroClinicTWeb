<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paziente extends Model
{
    protected $table = 'paziente';
    protected $primaryKey = 'username';
    protected $guarded = ['username'];
    public $timestamps = false; 
}
