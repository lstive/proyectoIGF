<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Taxista;
use App\Models\Cliente;

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
        
        return view('login');
    }

    public function login() {
        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        if(auth()->attempt($credentials)) {
            if(auth()->user()->rol == 'admin') {
                return redirect(route('admins.index'));
            }else if(auth()->user()->rol == 'operator') {
                return redirect(route('operators.index'));
            }
        }

        return redirect('login');
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
}
