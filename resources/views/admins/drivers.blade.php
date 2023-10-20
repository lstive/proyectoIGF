@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="container">

  <!-- form -->
  <div class="shadow-container">
    
    <div class="form-container">
      <form method="post" action="/api/addClient">
        @csrf
        <button class="close-shadow-container button">Cerrar</button>
        <hr/>
        <input name="id" type="text" value="" placeholder="id" hidden/><br/>
        <input name="name" type="text" value="" placeholder="Nombre"/><br/>
        <input name="phone" type="text" value="" placeholder="Telefono"/><br/>
        <input name="direction" type="text" value="" placeholder="Dirección"/><br/>
        <div>
          <input name="" type="submit" value="Agregar"/>
          <input name="" type="submit" value="Guardar cambios"/>
        </div>
      </form>
    </div>
  </div>
  <!-- form end -->
  
  <div class="left-container">
    @component('components.userMenu')
    <div><a href="{{route('admins.index')}}">Inicio</a></div>
    <div><a href="{{route('admins.operators')}}">Operadores</a></div>
    <div class="active-menu"><a href="{{route('admins.drivers')}}">Taxistas</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">
    <div class="sub-container" style="top: 0px; position: sticky;">
      <button class="open-shadow-container button">Agregar nuevo</button>
    </div>

    <div class="sub-container">
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Licensia</th>
            <th>Dirección</th>
            <th>Contraseña</th>
            <th colspan="2">Controles</th>
          </tr>
        </thead>
        <tbody>
          @foreach($drivers as $driver)
          <tr>
            <td>{{$driver->id}}</td>
            <td>{{$driver->name}}</td>
            <td>{{$driver->email}}</td>
            <td>{{$driver->phone}}</td>
            <td>{{$driver->license}}</td>
            <td>{{$driver->direction}}</td>
            <td>-</td>
            <td><button id="btn-delete-driver" value-id="{{$driver->id}}" value-rol="{{$driver->rol}}" class="button">Borrar</button></td>
            <td><button id="btn-modify-driver" class="open-shadow-container button" value-id="{{$driver->id}}" value-name="{{$driver->name}}" value-email="{{$driver->email}}" value-phone="{{$driver->phone}}" value-direction="{{$driver->direction}}" value-license="{{$driver->license}}" value-password="{{$driver->password}}" class="button">Modificar</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/scripts/user/script.js"></script>
@endpush
