<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Taxista;
use App\Models\Cliente;
use App\Models\Viaje;
use Illuminate\Validation\Rule;


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

    /*public function getDrivers() {
        return Taxista::all()->count();
    }*/

    public function destroyOperator(string $id) {

        User::destroy($id);
        return redirect(route('admins.operators', ['ok' => 1]))->with('borrado', 'Taxista eliminado exitosamente');
    }

    public function addOperator() {
        $request = request();
        $rules = [
            'name' => ['regex:/^[A-Za-z\- ]+$/','min:5','max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->id)],
            
        ];
    
        // Define mensajes personalizados para las reglas de validación
        $customMessages = [
            'name.regex' => 'Ingrese solo caracteres validos',
            'name.min' => 'El campo nombre debe tener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no debe exceder los 50 caracteres.',
            'email' => 'El campo debe ser una dirección de correo electrónico válida.',
            'email.unique'=>'Este correo electronico esta en uso',
        ];    


        if(!request()->get('id')) {

            $rules['password'] = 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';
            $customMessages['password.regex'] = 'La contraseña debe contener al menos una minúscula, una mayúscula, un número, un carácter especial y tener una longitud entre 8 y 15 caracteres.';
            $customMessages['password.required'] = 'Ingrese una contraseña';

            /*$input = [
                request()->get('name'),
                request()->get('email'),
                request()->get('password'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.operators', ['ok' => -1]))->with('actualizacion', 'Operador  exitosamente'); //Cuando entra?
                }
            }*/
            
            $user = new User;
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            $user->password = bcrypt(request()->get('password'));

            $this->validate($request, $rules, $customMessages);
            $user->save();
        }else {

            /*
            $input = [
                request()->get('name'),
                request()->get('email'),
            ];

            foreach($input as $value) {
                if($value == '' | $value == null) {
                    return redirect(route('admins.operators', ['ok' => -1]))->with('actualizacion', 'Operador Actualizado exitosamente');
                }
            }*/
            
            $user = User::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->email = request()->get('email');
            $user->rol = 'operator';
            if(request()->get('password') != '') {
                $rules['password'] = 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';
                $customMessages['password.regex'] = 'La contraseña debe contener al menos una minúscula, una mayúscula, un número, un carácter especial y tener una longitud entre 8 y 15 caracteres.';
                $customMessages['password.required'] = 'Ingrese una contraseña';
                $user->password = bcrypt(request()->get('password'));
            }
            $this->validate($request, $rules, $customMessages);
            $user->save();
            return redirect(route('admins.operators', ['ok' => 1]))->with('actualizacion', 'Operador Actualizado exitosamente');
        }
        
        return redirect(route('admins.operators', ['ok' => 1]))->with('registro', 'Operador registrado exitosamente');
    }

    public function destroyDriver(string $id) {
        Taxista::destroy($id);
        return redirect(route('admins.drivers', ['ok' => 1]))->with('borrado', 'Taxista eliminado exitosamente');
    }

    public function addDriver() {
        // Accede a la instancia de Request para obtener los datos del formulario
        $request = request();
    
        // Define las reglas de validación para los campos del formulario
        $rules = [
            'name' => ['regex:/^[A-Za-z\- ]+$/','min:5','max:50'],
            'email' => ['required', 'email', Rule::unique('taxistas', 'email')->ignore($request->id)],
            'phone' => ['regex:/^\d{8}$/','required',Rule::unique('taxistas', 'phone')->ignore($request->id)],
            'license' => ['regex:/^\d{14}$/',Rule::unique('taxistas', 'license')->ignore($request->id)],
            'direction' => 'required|string|min:15|max:100',
        ];
    
        // Define mensajes personalizados para las reglas de validación
        $customMessages = [
            'name.regex' => 'Ingrese solo caracteres validos',
            'name.min' => 'El campo nombre debe tener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no debe exceder los 50 caracteres.',
            'email' => 'El campo debe ser una dirección de correo electrónico válida.',
            'email.unique'=>'Este correo electronico esta en uso',
            'phone.regex' => 'Ingrese un número de teléfono válido (8 dígitos).',
            'phone.unique'=>'Este telefono se encuentra en uso',
            'license.regex' => 'Ingrese un número de licencia valido',
            'license.unique'=>'Esta licencia ya se encuentra registrada',
            'direction.min' => 'El campo direccion debe tener al menos 15 caracteres.',
            'direction.max' => 'El campo direccion no debe exceder los 100 caracteres.'
        ];
    
        if (!$request->get('id')) {
            // Resto de lógica para agregar un taxista

            $rules['password'] = 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';
            $customMessages['password.regex'] = 'La contraseña debe contener al menos una minúscula, una mayúscula, un número, un carácter especial y tener una longitud entre 8 y 15 caracteres.';
            $customMessages['password.required'] = 'Ingrese una contraseña';

            $user = new Taxista;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->license = $request->get('license');
            $user->direction = $request->get('direction');
            $user->password = bcrypt($request->get('password'));

            // Realiza la validación utilizando las reglas definidas y la instancia de Request
            $this->validate($request, $rules, $customMessages);
            $user->save();
        } else {
            // Resto de  lógica para modificar un taxista
            $user = Taxista::find($request->get('id'));
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->license = $request->get('license');
            $user->direction = $request->get('direction');
            if ($request->get('password') != '') {
                $rules['password'] = 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';
                $customMessages['password.regex'] = 'La contraseña debe contener al menos una minúscula, una mayúscula, un número, un carácter especial y tener una longitud entre 8 y 15 caracteres.';
                $customMessages['password.required'] = 'Ingrese una contraseña';
                $user->password = bcrypt($request->get('password'));
            }

            // Realiza la validación utilizando las reglas definidas y la instancia de Request
            $this->validate($request, $rules, $customMessages);
            $user->save();
            return redirect(route('admins.drivers', ['ok' => 1]))->with('actualizacion', 'Taxista actualizado exitosamente');
        }
        return redirect(route('admins.drivers', ['ok' => 1]))->with('registro', 'Taxista registrado exitosamente');
    }
    

    public function addClient() {
       /* $input = [
            request()->get('name'),
            request()->get('phone'),
            request()->get('direction'),
        ];*/
        $request = request();
    
        // Define las reglas de validación para los campos del formulario
        $rules = [
            'name' => ['regex:/^[A-Za-z\- ]+$/','min:5','max:50'],
            'phone' => ['regex:/^\d{8}$/','required',Rule::unique('clientes', 'phone')->ignore($request->id)],
            'direction' => 'required|string|min:15|max:100',
        ];
    
        // Define mensajes personalizados para las reglas de validación
        $customMessages = [
            'name.regex' => 'Ingrese solo caracteres validos',
            'name.min' => 'El campo nombre debe tener al menos 5 caracteres.',
            'name.max' => 'El campo nombre no debe exceder los 50 caracteres.',
            'phone.regex' => 'Ingrese un número de teléfono válido (8 dígitos).',
            'phone.unique'=>'Este telefono se encuentra en uso',
            'direction.min' => 'El campo direccion debe tener al menos 15 caracteres.',
            'direction.max' => 'El campo direccion no debe exceder los 100 caracteres.'
        ];
        /*foreach($input as $value) {
            if($value == '' | $value == null) {
                return redirect(route('operators.clients', ['ok' => -1]));
            }
        }*/
        
        if(!request()->get('id')) {
            $user = new Cliente;
            $user->name = request()->get('name');
            $user->phone = request()->get('phone');
            $user->direction = request()->get('direction');
            $this->validate($request, $rules, $customMessages);
            $user->save();
        }else {
            $user = Cliente::find(request()->get('id'));
            $user->name = request()->get('name');
            $user->phone = request()->get('phone');
            $user->direction = request()->get('direction');
            $this->validate($request, $rules, $customMessages);
            $user->save();
            return redirect(route('operators.clients', ['ok' => 1]))->with('actualizacion', 'Cliente actualizado exitosamente');
        }
        
        return redirect(route('operators.clients', ['ok' => 1]))->with('registro', 'Cliente registrado exitosamente');
    }

    public function destroyClient($id) {
        Cliente::destroy($id);
        return redirect(route('operators.clients', ['ok' => 1]))->with('borrado', 'Cliente eliminado exitosamente');
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
