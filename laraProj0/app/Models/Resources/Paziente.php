<?php

namespace App\Models\Resources;
use App\Models\User;
use App\Models\Resources\Episodio;

use Illuminate\Database\Eloquent\Model;

class Paziente extends Model
{
    protected $table = 'paziente';
    protected $primaryKey = 'username';
    protected $keyType = 'string';
    //protected $guarded = ['username'];
    public $timestamps = false;
    protected $fillable = ['username', 'nome', 'cognome', 'dataNasc', 'genere', 'via',
     'civico', 'citta', 'prov', 'telefono', 'email', 'clinico'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function episodi()
    {
        return $this->hasMany(Episodio::class, 'paziente', 'username');
    }
}
