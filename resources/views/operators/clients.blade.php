@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
<link href="/styles/notify.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="container">
  @include('components.notify', ['ok' => 'Exito al hacer cambios', 'error' => 'Error al hacer cambios'])

  <!-- form -->
  <div class="shadow-container">
    
    <div class="form-container">
      <form method="post" action="/api/addClient">
        @csrf
        <button type ="button"class="close-shadow-container button" id="closeButton">Cerrar</button>
        <hr/>
        <input name="id" type="text" value="{{ old('id') }}" placeholder="id" hidden/><br/>
        <div class="formulario-campo">
          <label for="name">Nombre</label>
          <input name="name" type="text" value="{{ old('name') }}" id="name" placeholder="Nombre" required/>
          @error('name')
            <small style="color: red;">{{ $message }}</small>
          @enderror
        </div>
        <div class="formulario-campo">
          <label for="name">Nombre</label>
          <input name="phone" type="text" value="{{ old('phone') }}" id="phone" placeholder="Telefono" required/>
          @error('phone')
            <small style="color: red;">{{ $message }}</small>
          @enderror
        </div>
        <div class="formulario-campo">
          <label for="name">Nombre</label>
          <input name="direction" type="text" value="{{ old('direction') }}" id="direction" placeholder="Direccion" required/>
          @error('direction')
            <small style="color: red;">{{ $message }}</small>
          @enderror
        </div>
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
    <div><a href="{{route('operators.index')}}">Inicio</a></div>
    <div class="active-menu"><a href="{{route('operators.clients')}}">Clientes</a></div>
    <div><a href="{{route('operators.trips')}}">Viajes</a></div>
    <div><a href="{{route('operators.travels')}}">Viajes registrados</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">
    <div class="sub-container" style="top: 0px; position: sticky;">
      <button class="open-shadow-container-client button">Agregar nuevo</button>
    </div>
    @if(session('registro'))
      <div class="sub-container alert-dismissible fade show" role="alert" style="background-color: #28a745; color: #fff; padding: 10px; border-radius: 4px;">
        {{ session('registro') }}
      </div>
    @endif
    @if(session('actualizacion'))
      <div class="sub-container alert-dismissible fade show" role="alert" style="background-color: #007BFF; color: #fff;" padding: 10px; border-radius: 4px;">
        {{ session('actualizacion') }}
      </div>
    @endif
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
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Dirección</th>
            <th colspan="2">Controles</th>
          </tr>
        </thead>
        <tbody>
          @foreach($clients as $client)
          <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->name}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->direction}}</td>
            <td><button id="btn-delete-client" value-id="{{$client->id}}" class="button">Borrar</button></td>
            <td><button id="btn-modify-client" class="open-shadow-container button" value-id="{{$client->id}}" value-name="{{$client->name}}" value-phone="{{$client->phone}}" value-direction="{{$client->direction}}" class="button">Modificar</button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection

@push('scripts')

@if(count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          if(document.querySelector('input[name="id"]').value ===''){
            //esto literal no hace nada pero invoca a traer el id de nuevo para no perder el registro cuando se vuelva a subir una solicitud
          }
            const shadowContainer = document.getElementsByClassName('shadow-container')[0]
            shadowContainer.classList.add('toggle-shadow-container')
        });
    </script>
  @endif

<script>
  document.getElementsByTagName('table')[0].addEventListener('click', event => {
      if (event.target.getAttribute('value-rol') == 'operator') {
          if (event.target.innerText == 'Modificar') {
              console.log('gaaaaa')
              shadowContainer.classList.toggle('toggle-shadow-container')
              document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
              document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
              document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
              document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
          }
      }
  })

  const closeButton = document.getElementById('closeButton');

// Agrega un evento de clic al botón
closeButton.addEventListener('click', function() {
  shadowContainer.classList.toggle('toggle-shadow-container');
  
});
</script>
<script src="/scripts/user/operator/script.js"></script>
<script src="/scripts/user/script.js"></script>
<script>
  
const openShadowContainerClient = document.getElementsByClassName('open-shadow-container-client')[0]
openShadowContainerClient.addEventListener('click', () => {
  
  //document.getElementById('changePasswordField').style.display = 'none';
  document.querySelector('input[name="id"]').value = '';
  document.querySelector('input[name="name"]').value = ''
  document.querySelector('input[name="phone"]').value = '';
  document.querySelector('input[name="direction"]').value = '';
  shadowContainer.classList.toggle('toggle-shadow-container')
})
  document.getElementsByTagName('table')[0].addEventListener('click', event => {
      if (event.target.innerText == 'Modificar') {
          shadowContainer.classList.toggle('toggle-shadow-container')
          document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
          document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
          document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
          document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
      }
  })
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
<script>

@endpush
