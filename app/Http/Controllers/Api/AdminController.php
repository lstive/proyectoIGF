<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Taxista;
use App\Models\Cliente;
use App\Models\Viaje;

class AdminController extends Controller
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

    public function getOperators() {
        return User::all()->where('rol', 'operator')->count();
    }

    public function getDrivers() {
        return Taxista::all()->count();
    }

    public function destroyOperator(string $id) {
        User::destroy($id);
        return redirect(route('admins.operators', ['ok' => 1]));
    }

    public function addOperator() {
        if(!request()->get('id')) {
            $input = [
                request()->get('name'),
                request()->get('email'),
                request()->get('password'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.operators', ['ok' => -1]));
                }
            }
            
            $user = new User;
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            $user->password = bcrypt(request()->get('password'));
            $user->save();
        }else {
            $input = [
                request()->get('name'),
                request()->get('email'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.operators', ['ok' => -1]));
                }
            }
            
            $user = User::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            if(request()->get('password') != '') {
                $user->password = bcrypt(request()->get('password'));
            }
            
            $user->save();
        }
        
        return redirect(route('admins.operators', ['ok' => 1]));
    }

    public function destroyDriver(string $id) {
        Taxista::destroy($id);
        return redirect(route('admins.drivers', ['ok' => 1]));
    }

    public function addDriver() {
        if(!request()->get('id')) {
            $input = [
                request()->get('name'),
                request()->get('email'),
                request()->get('phone'),
                request()->get('license'),
                request()->get('direction'),
                request()->get('password'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.drivers', ['ok' => -1]));
                }
            }
            
            $user = new Taxista;
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->phone = request()->get('phone');
            $user->license = request()->get('license');
            $user->direction = request()->get('direction');
            $user->password = bcrypt(request()->get('password'));
            $user->save();
        }else {
            $input = [
                request()->get('name'),
                request()->get('email'),
                request()->get('phone'),
                request()->get('license'),
                request()->get('direction'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.drivers', ['ok' => -1]));
                }
            }
            
            $user = Taxista::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->phone = request()->get('phone');
            $user->license = request()->get('license');
            $user->direction = request()->get('direction');
            if(request()->get('password') != '') {
                $user->password = bcrypt(request()->get('password'));
            }
            
            $user->save();
        }
        
        return redirect(route('admins.drivers', ['ok' => 1]));
    }

    public function addClient() {
        $input = [
            request()->get('name'),
            request()->get('phone'),
            request()->get('direction'),
        ];

        foreach($input as $value) {
            if($value == '' | $value == null) {
                return redirect(route('operators.clients', ['ok' => -1]));
            }
        }
        
        if(!request()->get('id')) {
            $user = new Cliente;
            $user->name = request()->get('name');
            $user->phone = request()->get('phone');
            $user->direction = request()->get('direction');
            $user->save();
        }else {
            $user = Cliente::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->phone = request()->get('phone');
            $user->direction = request()->get('direction');
            $user->save();
        }
        
        return redirect(route('operators.clients', ['ok' => 1]));
    }

    public function destroyClient($id) {
        Cliente::destroy($id);
        return redirect(route('operators.clients', ['ok' => 1]));
    }

    // filter
    public function filterClients() {
        return DB::table('clientes')->where(request()->get('filterBy'), 'like', '%' . request()->get('filter') .'%')->get();
    }

    public function filterDrivers() {
        return DB::table('taxistas')->where(request()->get('filterBy'), 'like', '%' . request()->get('filter') .'%')->get();
    }

    public function addTravel() {
        $input = [
            request()->get('user_id'),
            request()->get('client-id'),
            request()->get('driver-id'),
            request()->get('from'),
            request()->get('from-coords'),
            request()->get('to'),
            request()->get('to-coords'),
            request()->get('indications'),
            request()->get('price'),
            request()->get('number'),
            request()->get('date'),
        ];

        foreach($input as $value) {
            if($value == '' | $value == null) {
                return redirect(route('operators.trips', ['ok' => -1]));
            }
        }
        
        $viaje = new Viaje;
        $viaje->user_id = request()->get('user_id');
        $viaje->cliente_id = request()->get('client-id');
        $viaje->taxista_id = request()->get('driver-id');
        $viaje->from = request()->get('from');
        $viaje->from_coords = request()->get('from-coords');
        $viaje->to = request()->get('to');
        $viaje->to_coords = request()->get('to-coords');
        $viaje->indications = request()->get('indications');
        $viaje->price = request()->get('price');
        $viaje->passengers = request()->get('number');
        $viaje->fecha = request()->get('date');
        $viaje->estado = 'disponible';
        $viaje->save();

        return redirect(route('operators.trips', ['ok' => 1]));
    }

    public function destroyTravel($id) {
        Viaje::destroy($id);
        return $id;
    }
}
