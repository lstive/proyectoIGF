<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Taxista;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        if(auth()->check()) {
            if(auth()->user()->rol == 'admin') {
                return redirect(route('admins.index'));
            }else if(auth()->user()->rol == 'operator') {
                return redirect(route('operators.index'));
            }
        }

        if(auth()->guard('driver')->check()) {
            return redirect(route('drivers.index'));
        }
        
        return view('login');
    }

    public function login() {
        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        if(auth()->guard('driver')->attempt($credentials)){
            return redirect(route('drivers.index'));
        }

        if(auth()->attempt($credentials)) {
            if(auth()->user()->rol == 'admin') {
                return redirect(route('admins.index'));
            }else if(auth()->user()->rol == 'operator') {
                return redirect(route('operators.index'));
            }
        }

        return redirect('login');
    }


    public function logoutDriver() {
        auth()->guard('driver')->logout();
        return redirect(route('login'));
    }
    
    public function logout() {
        auth()->logout();
        
        return redirect(route('login'));
    }

    public function operators() {
        $operators = User::all()->where('rol', 'operator');
        return view('admins.operators')->with('operators', $operators);
    }

    public function drivers() {
        $drivers = Taxista::all();
        return view('admins.drivers')->with('drivers', $drivers);
    }

    // operators views
    public function clients() {
        $clients = Cliente::all();
        return view('operators.clients')->with('clients', $clients);
    }

    public function trips() {
        return view('operators.trips');
    }

    public function travels() {
        return view('operators.travels')->with('travels', DB::select('SELECT viajes.id as id, viajes.fecha as fecha, clientes.name as cliente, taxistas.name as taxista, viajes.from as "from", viajes.to as "to" from clientes inner join viajes on clientes.id=viajes.cliente_id inner join users on users.id=viajes.user_id inner join taxistas on viajes.taxista_id=taxistas.id;'));
    }
}
