<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Diagnosi;

class DistMotorio extends Model
{
   protected $table = 'distmotorio';
   // cambiare tipo di primaryKey, tanta roba da aggiustare nei seeder e nelle relationships
   protected $primaryKey = 'nome';
   protected $keyType = 'string';
   public $timestamps = false;
   protected $fillable = ['nome', 'categoria'];

   public function diagnosi()
   {
      return $this->hasMany(Diagnosi::class, 'disturbo', 'nome');
   }
  

}
