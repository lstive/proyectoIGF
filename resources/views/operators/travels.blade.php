@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="container">

  <div class="left-container">
    @component('components.userMenu')
    <div><a href="{{route('operators.index')}}">Inicio</a></div>
    <div><a href="{{route('operators.clients')}}">Clientes</a></div>
    <div><a href="{{route('operators.trips')}}">Viajes</a></div>
    <div class="active-menu"><a href="{{route('operators.travels')}}">Viajes registrados</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">
    <div class="sub-container">
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Conductor</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha</th>
            <th colspan="2">Controles</th>
          </tr>
        </thead>
        <tbody>
          @foreach($travels as $travel)
          <tr>
            <td>{{$travel->id}}</td>
            <td>{{$travel->cliente}}</td>
            <td>{{$travel->taxista}}</td>
            <td>{{$travel->from}}</td>
            <td>{{$travel->to}}</td>
            <td>{{$travel->fecha}}</td>
            <td><button value-id="{{$travel->id}}" class="button">Borrar</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementsByTagName('button')[0].addEventListener('click', event => {
      event.preventDefault()
      if(event.target.innerText == 'Borrar') {
          (async () => {
              const res = await fetch('/api/deleteTravel/' + event.target.getAttribute('value-id'), {
                  method: 'delete'
              })

              window.location.reload()
          })()
      }
  })
</script>

@endpush
