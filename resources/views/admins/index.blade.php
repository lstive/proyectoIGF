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
      <form method="get" action="/auth">
        @csrf
        <button class="close-shadow-container">close</button>
        <input name="email" type="text" value="" placeholder="Email"/><br/>
        <input name="password" type="text" value="" placeholder="Contraseña"/><br/>
        <input name="password" type="text" value="" placeholder="Contraseña"/><br/>
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
    <div class="active-menu"><a href="{{route('admins.index')}}">Inicio</a></div>
    <div><a href="{{route('admins.operators')}}">Operadores</a></div>
    <div><a href="{{route('admins.drivers')}}">Taxistas</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">
    <div class="sub-container">
      <h1>Hola. Bienvenido {{auth()->user()->name}}</h1>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/scripts/user/script.js"></script>
@endpush
