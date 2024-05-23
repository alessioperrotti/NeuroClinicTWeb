<?php

namespace App\Models\Resources;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Paziente extends Model
{
    protected $table = 'paziente';
    protected $primaryKey = 'username';
    // protected $guarded = ['username'];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
