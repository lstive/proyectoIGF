<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        if(auth()->check()) {
            if(auth()->user()->rol == 'admin') {
                return redirect('/admin');
            }else if(auth()->user()->rol == 'operator') {
                return redirect('/operator');
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
                return redirect('/admin');
            }else if(auth()->user()->rol == 'operator') {
                return redirect('/operator');
            }
        }

        return redirect('login');
    }
}
