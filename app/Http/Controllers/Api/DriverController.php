<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Viaje;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function driveBegin() {
        $viajes = Viaje::where('estado', 'en curso')->get()->count();

        if($viajes == 0) {
            $viaje = Viaje::find(request()->get('id'));
            $viaje->estado = 'en curso';
            $viaje->save();
        }
        
        return $viaje->id;
    }

    public function driveEnd() {
        $viaje = Viaje::find(request()->get('id'));
        $viaje->estado = 'terminado';
        $viaje->save();
        return $viaje->id;
    }
}
