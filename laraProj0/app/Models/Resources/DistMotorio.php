<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Diagnosi;

class DistMotorio extends Model
{
   protected $table = 'distmotorio';
   protected $primaryKey = 'nome';
   protected $keyType = 'string';
   public $timestamps = false;
   protected $fillable = ['nome', 'categoria'];

   public function diagnosi()
   {
      return $this->hasMany(Diagnosi::class, 'disturbo', 'nome');
   }
   public function episodi()
   {
      return $this->hasMany(Episodio::class, 'disturbo', 'id');
   }

}
