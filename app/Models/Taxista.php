<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Viaje;

class Taxista extends Authenticatable
{
    use HasFactory;
    public function travels() {
        return $this->hasMany(Viaje::class);
    }
}
