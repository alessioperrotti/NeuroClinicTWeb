<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class DistMotorio extends Model
{
   protected $table = 'distmotorio';
   protected $primaryKey = 'nome';
   protected $keyType = 'string';
   public $timestamps = false;

}
