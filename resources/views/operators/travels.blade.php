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
    @if(session('borrado'))
      <div class="sub-container alert-dismissible fade show" role="alert" style="background-color: #FF6B6B; color: #fff;" padding: 10px; border-radius: 4px;">
        {{ session('borrado') }}
      </div>
    @endif
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
  document.getElementsByTagName('table')[0].addEventListener('click', event => {
    event.preventDefault();
    if (event.target.innerText == 'Borrar') {
      const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este registro?');
      if (confirmDelete) {
        (async () => {
          const res = await fetch('/api/deleteTravel/' + event.target.getAttribute('value-id'), {
            method: 'delete'
          });
          window.location.reload();
        })();
      }
    }
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-dismissible").alert('close');
        });
        $('[data-toggle="tooltip"]').tooltip({
            trigger : 'hover'
        });
    });
  </script>

@endpush
