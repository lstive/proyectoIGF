@extends('components.layout.layout')

@push('styles')
<link href="/styles/user/styles.css" rel="stylesheet"/>
<link href="/styles/user/user-menu.css" rel="stylesheet"/>
<link href="/styles/user/form.css" rel="stylesheet"/>
<link href="/styles/notify.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="container">
  

  <!-- form -->
  <div class="shadow-container">

  <div class="form-container">
    <form method="post" action="/api/addDriver">
      @csrf
      <button type ="button"class="close-shadow-container button" id="closeButton">Cerrar</button>
      <hr />
      <input name="id" type="text" value="{{ old('id') }}" placeholder="id" hidden />

      <div class="formulario-campo">
        <label for="name">Nombre</label>
        <input name="name" type="text" value="{{ old('name') }}" id="name" placeholder="Nombre" required />
        @error('name')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>

      <div class="formulario-campo">
        <label for="email">Email</label>
        <input name="email" type="text" value="{{ old('email') }}" id="email" placeholder="Email" required/>
        @error('email')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>

      <div class="formulario-campo">
        <label for="phone">Teléfono</label>
        <input name="phone" type="text" value="{{ old('phone') }}" id="phone" placeholder="Teléfono" required/>
        @error('phone')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>

      <div class="formulario-campo">
        <label for="license">Licencia</label>
        <input name="license" type="text" value="{{ old('license') }}" id="license" placeholder="Licencia" required/>
        @error('license')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>

      <div class="formulario-campo">
        <label for="direction">Dirección</label>
        <input name="direction" type="text" value="{{ old('direction') }}" id="direction" placeholder="Dirección" required/>
        @error('direction')
        <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>


      <div class="formulario-campo" id="changePasswordField" style="display: none;">
        <input type="checkbox" id="changePassword" name="changePassword" {{ old('changePassword') ? 'checked' : '' }}>
        <label for="changePassword">Cambiar contraseña</label>
      </div>

      <div class="formulario-campo" id = "password-div" style= "display: none;">
        <div style="display: flex;">
          <input name="password" type="password" value="" id="password" placeholder="Contraseña"/>
          <button type="button" id="showPassword">Mostrar</button>
        </div>
        @error('password')
          <small style="color: red;">{{ $message }}</small>
        @enderror
      </div>
      <div>
        <div style="display: none;" id ="btn-Agregar">
          <input name="" type="submit" value="Agregar"/>
        </div>
        <div style="display: none;" id ='btn-Guardar'>
          <input name="" type="submit" value="Guardar cambios" />
        </div>
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
      <button id="btn-new-driver" class="open-shadow-container button">Agregar nuevo</button>
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
        <thead style = "text-align: left;">
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Licencia</th>
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
            <td><button id="btn-modify-driver" class="open-shadow-container button" value-id="{{$driver->id}}" value-name="{{$driver->name}}" value-email="{{$driver->email}}" value-phone="{{$driver->phone}}" value-direction="{{$driver->direction}}" value-license="{{$driver->license}}" value-password="" class="button">Modificar</button></td>
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
  @if(count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const shadowContainer = document.getElementsByClassName('shadow-container')[0]
            if(document.querySelector('input[name="id"]').value ===''){
              document.getElementById('changePasswordField').style.display = 'none';
              document.getElementById('changePassword').checked = true;
              document.getElementById('password-div').style.display = 'block'
            }
            else {
              document.getElementById('changePasswordField').style.display = 'block';
            }
            shadowContainer.classList.add('toggle-shadow-container')
        });
    </script>
  @endif

<script>
  document.getElementsByTagName('table')[0].addEventListener('click', event => {
      event.preventDefault()
      
      if (event.target.innerText === 'Modificar') { 
          document.getElementById('btn-Agregar').style.display = 'none'
          document.getElementById('btn-Guardar').style.display = 'block'
          document.getElementById('changePasswordField').style.display = 'block'
          document.querySelector('input[name="id"]').value = event.target.getAttribute('value-id')
          document.querySelector('input[name="name"]').value = event.target.getAttribute('value-name')
          document.querySelector('input[name="email"]').value = event.target.getAttribute('value-email')
          document.querySelector('input[name="phone"]').value = event.target.getAttribute('value-phone')
          document.querySelector('input[name="license"]').value = event.target.getAttribute('value-license')
          document.querySelector('input[name="direction"]').value = event.target.getAttribute('value-direction')
          document.getElementById('changePassword').checked = false;
          document.getElementById('password-div').style.display = 'none'

          shadowContainer.classList.toggle('toggle-shadow-container')

      }
  })

  // admin drivers crud
  document.getElementsByTagName('table')[0].addEventListener('click', event => {
    event.preventDefault();
    if (event.target.innerText === 'Borrar') {
      const id = event.target.getAttribute('value-id');
      // Mostrar un cuadro de diálogo de confirmación
      if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
        // El usuario ha confirmado, entonces eliminamos el registro
        fetch('/api/deleteDriver/' + id, {
          method: 'delete'
        }).then(response => {
          window.location.reload();
        });
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
<script>
const closeButton = document.getElementById('closeButton');

// Agrega un evento de clic al botón
closeButton.addEventListener('click', function() {
  
  document.querySelector('input[name="password"]').value = '';
  shadowContainer.classList.toggle('toggle-shadow-container');
  
});


const passwordField = document.getElementById('password');
    const showPasswordButton = document.getElementById('showPassword');

    showPasswordButton.addEventListener('click', function () {
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            showPasswordButton.textContent = 'Ocultar';
        } else {
            passwordField.type = 'password';
            showPasswordButton.textContent = 'Mostrar';
        }
    });

    const changePasswordCheckbox = document.getElementById('changePassword')
    changePasswordCheckbox.addEventListener('change', function() {

        if (this.checked) {
            document.getElementById('password-div').style.display = 'block'
        } else {
            // Si el checkbox no está seleccionado, oculta el campo de contraseña
            document.getElementById('password-div').style.display = 'none'
        }
    });
</script>
@endpush
