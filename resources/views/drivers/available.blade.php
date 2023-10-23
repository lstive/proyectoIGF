@extends('components.layout.driverLayout')

@push('styles')
<link href="/styles/globals.css" rel="stylesheet"/>
<link href="/styles/driver/styles.css" rel="stylesheet"/>
@endpush

@section('content')
@component('components.navbar')
<div>
  <a href="{{route('drivers.index')}}">Inicio</a>
</div>
<div>
  <a class="active" href="">Viajes disponibles</a>
</div>
<div>
  <a href="{{route('drivers.doing')}}">Viajes en curso</a>
</div>
@endcomponent

<div class="container">
  <div class="row">
    
    @foreach($travels as $travel)
    <div class="md-column-2">
      <div class="sub-content">
        <button value-id="{{$travel->id}}" class="button">Iniciar</button>
        <h2>Origen</h2>
        {{$travel->from}}
        <h2>Destino</h2>
        {{$travel->to}}
      </div>
    </div>
    @endforeach      
  </div>
</div>
@endsection

@push('scripts')
<script src="/scripts/user/driver/script.js"></script>
@endpush

