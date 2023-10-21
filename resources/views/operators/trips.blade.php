@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
<link href="/styles/user/trips-form.css" rel="stylesheet"/>
<link href="/styles/user/google.css" rel="stylesheet"/>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
@endpush

@section('content')
<div class="container">

  <!-- lateral -->
  <div class="left-container">
    @component('components.userMenu')
    <div><a href="{{route('operators.index')}}">Inicio</a></div>
    <div><a href="{{route('operators.clients')}}">Clientes</a></div>
    <div class="active-menu"><a href="{{route('operators.trips')}}">Viajes</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  <!-- lateral end -->
  
  <div class="right-container">
    <div class="sub-container">
      <div class="interactive">
        <div id="map"></div>
      </div>
    </div>

    
    <div class="sub-container">
      @include('components.trips.trips-form')
    </div>
    
  </div>
</div>
@endsection

@push('scripts')

<script src="/scripts/user/operator/google.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3z9M3X6r5rI8mu4d_1IdEqms72ntbt9c
         &callback=initMap&v=weekly"
    defer
></script>
@endpush
