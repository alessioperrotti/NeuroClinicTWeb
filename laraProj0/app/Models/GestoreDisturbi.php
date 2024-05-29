<?php

namespace App\Models;

use App\Models\Resources\DistMotorio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


class GestoreDisturbi extends Model
{
    use HasFactory;

    public function getDisturbi():Collection {
        $disturbi = DistMotorio::all();
        return $disturbi;
    }
    public function getDisturbo($id):DistMotorio {
        $disturbo = DistMotorio::findOrFail($id);
        return $disturbo;
    }
    
}

