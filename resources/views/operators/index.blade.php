<<<<<<< Updated upstream
@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush

@section('content')
<div class="container">
  <div class="left-container">
    @component('components.userMenu')
    <div class="active-menu"><a href="{{route('admins.index')}}">Inicio</a></div>
    <div><a href="{{route('operators.clients')}}">Clientes</a></div>
    <div><a href="{{route('operators.trips')}}">Viajes</a></div>
    <div><a href="{{route('operators.travels')}}">Viajes registrados</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">
    <div class="sub-container">
      <h1>Bienvenido {{auth()->user()->name}}</h1>
    </div>
  </div>
</div>
@endsection

@push('scripts')
@endpush
=======
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Google Maps API Example</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3z9M3X6r5rI8mu4d_1IdEqms72ntbt9c"></script>
</head>
<body>
  <div id="map"></div>
  <script>
    // Crea un nuevo mapa
    var map = new google.maps.Map(document.getElementById("map"));

    // Centra el mapa en Manhattan
    map.setCenter({lat: 40.712783, lng: -74.005942});

    // Agrega un marcador al mapa
    var marker = new google.maps.Marker({
      position: {lat: 40.712783, lng: -74.005942},
      map: map
    });
  </script>
</body>
</html>
>>>>>>> Stashed changes
