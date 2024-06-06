<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Messaggio extends Model
{
    protected $table = 'messaggio';
    protected $fillable = ['destinatario', 'contenuto'];

    public function mittente() {
        return $this->belongsTo(User::class, 'mittente', 'username');
    }

    public function destinatario() {
        return $this->belongsTo(User::class, 'destin', 'username');
    }
}
