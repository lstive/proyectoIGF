<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Viaje extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo(Cliente::class);
    }
}
