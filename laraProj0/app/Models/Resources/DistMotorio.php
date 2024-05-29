<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class DistMotorio extends Model
{
   protected $table = 'distmotorio';
   public $timestamps = false;

   protected $fillable = ['nome', 'categoria'];

   // manca relazione con diagnosi -> in merge prendere questo model da backend-clinico


}
