<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function available() {
        $travels = DB::select("SELECT viajes.from as `from`, viajes.to as `to`, viajes.id as id FROM viajes INNER JOIN taxistas ON viajes.taxista_id=taxistas.id WHERE viajes.estado='disponible'");
        return view('drivers.available')->with('travels', $travels);
    }

    public function doing() {
        $travels = DB::select("SELECT viajes.from_coords as from_coords, viajes.to_coords as to_coords, viajes.from as `from`, viajes.to as `to`, viajes.id as id FROM viajes INNER JOIN taxistas ON viajes.taxista_id=taxistas.id WHERE viajes.estado='en curso'");
        return view('drivers.doing')->with('travels', $travels);
    }
}
