<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Clinico extends Model
{
    protected $table = 'clinico';
    protected $primaryKey = 'username';
    protected $keyType = 'string';
    protected $guarded = ['username'];
    public $timestamps = false;

    protected $fillable = ['nome', 'cognome', 'ruolo', 'username', 'dataNasc', 'specializ'];

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function pazienti()
    {
        return $this->HasMany(Paziente::class, 'clinico', 'username');
    }
}
