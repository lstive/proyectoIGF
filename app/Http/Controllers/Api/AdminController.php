<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Taxista;

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
        return $id;
    }

    public function addOperator() {
        if(!request()->get('id')) {
            $user = new User;
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            $user->password = bcrypt(request()->get('password'));
            $user->save();
        }else {
            $user = User::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            if(request()->get('password') != '') {
                $user->password = bcrypt(request()->get('password'));
            }
            
            $user->save();
        }
        
        return redirect(route('admins.operators'));
    }

    public function destroyDriver(string $id) {
        Taxista::destroy($id);
        return $id;
    }

    public function addDriver() {
        if(!request()->get('id')) {
            $user = new Taxista;
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->phone = request()->get('phone');
            $user->license = request()->get('license');
            $user->direction = request()->get('direction');
            $user->password = bcrypt(request()->get('password'));
            $user->save();
        }else {
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
        
        return redirect(route('admins.drivers'));
    }
}
