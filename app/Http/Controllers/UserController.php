<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index() {
        if(auth()->check()) {
            if(auth()->user()->rol == 'admin') {
                return redirect('admins.index');
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
                return redirect('admins.index');
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
}
