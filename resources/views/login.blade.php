@extends('components.layout.layout')

<!-- styles stack -->
@push('styles')
<link href="/styles/login/styles.css" rel="stylesheet"/>
@endpush
<title>Iniciar Sesión</title>
<!-- styles stack end -->

<!-- content -->
@section('content')
<div class="login-container">
  <form method="get" action="/auth">
    @csrf
    <input name="email" type="text" value="" placeholder="Email"/><br/>
    <input name="password" type="password" value="" placeholder="Contraseña"/><br/>
    <input name="" type="submit" value="Iniciar sesión"/>
  </form>
</div>

@endsection
<!-- content end -->

<!-- scripts stack -->
@push('scripts')

@endpush
<!-- scripts stack end -->
