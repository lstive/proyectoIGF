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
      <form method="post" action="/api/addOperator">
        @csrf
        <button type ="button"class="close-shadow-container button" id="closeButton">Cerrar</button>
        <hr/>
        <input name="id" type="text" value="{{ old('id') }}" placeholder="id" hidden/>

        <div class="formulario-campo">
          <label for="name">Nombre</label>
          <input name="name" type="text" value="{{ old('name') }}" id="name" placeholder="Nombre" required/>
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

        <div class="formulario-campo" id="changePasswordField" style="display: none;">
          <input type="checkbox" id="changePassword" name="changePassword" {{ old('changePassword') ? 'checked' : '' }}>
          <label for="changePassword">Cambiar contraseña</label>
        </div>

        <div class="formulario-campo" id = "password-div">
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
    <div class="active-menu"><a href="{{route('admins.operators')}}">Operadores</a></div>
    <div><a href="{{route('admins.drivers')}}">Taxistas</a></div>
    <div><a href="{{route('user.logout')}}">Cerrar sesión</a></div>
    @endcomponent
  </div>
  
  <div class="right-container">

    <div class="sub-container" style="top: 0px; position: sticky;">
      <button class="open-shadow-container-operator button">Agregar nuevo</button>
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
        <thead style= "text-align: left;">
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

  
<script src="/scripts/user/script.js"></script>
<script>
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
</script>
@endpush
