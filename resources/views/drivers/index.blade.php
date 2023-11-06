@extends('components.layout.driverLayout')

@push('styles')
<link href="/styles/globals.css" rel="stylesheet"/>
<link href="/styles/driver/styles.css" rel="stylesheet"/>
@endpush
<title>Inicio</title>

@section('content')
@component('components.navbar')
<div>
  <a class="active" href="">Inicio</a>
</div>
<div>
  <a href="{{route('drivers.available')}}">Viajes disponibles</a>
</div>
<div>
  <a href="{{route('drivers.doing')}}">Viajes en curso</a>
</div>
<div>
  <a href="{{route('user.logoutDriver')}}">Cerrar Sesión</a>
</div>
@endcomponent
  
<div class="container">
  <div class="row">
    <div class="md-column-2">
      <div class="sub-content">
        <h1>Bienvenido {{auth()->guard('driver')->user()->name}}</h1>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/scripts/user/driver/script.js"></script>
@endpush
