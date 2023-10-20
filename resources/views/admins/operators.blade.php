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
      <form method="post" action="/api/addOperator">
        @csrf
        <button class="close-shadow-container button">Cerrar</button>
        <hr/>
        <input name="id" type="text" value="" placeholder="id" hidden/><br/>
        <input name="name" type="text" value="" placeholder="Nombre"/><br/>
        <input name="email" type="text" value="" placeholder="Email"/><br/>
        <input name="password" type="text" value="" placeholder="Contraseña"/><br/>
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
    <div class="active-menu"><a href="{{route('admins.operators')}}">Operadores</a></div>
    <div><a href="{{route('admins.drivers')}}">Taxistas</a></div>
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
            <th>Contraseña</th>
            <th colspan="2">Controles</th>
          </tr>
        </thead>
        <tbody>
          @foreach($operators as $operator)
          <tr>
            <td>{{$operator->id}}</td>
            <td>{{$operator->name}}</td>
            <td>{{$operator->email}}</td>
            <td>-</td>
            <td><button value-id="{{$operator->id}}" value-rol="{{$operator->rol}}" class="button">Borrar</button></td>
            <td><button class="open-shadow-container button" value-id="{{$operator->id}}" value-rol="{{$operator->rol}}" value-name="{{$operator->name}}" value-email="{{$operator->email}}" value-password="{{$operator->password}}" class="button">Modificar</button></td>
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
