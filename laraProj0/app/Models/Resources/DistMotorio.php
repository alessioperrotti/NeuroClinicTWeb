<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class DistMotorio extends Model
{
   protected $table = 'distmotorio';
   public $timestamps = false;

   protected $fillable = ['nome', 'categoria'];


}
