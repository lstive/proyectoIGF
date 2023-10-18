@extends('components.layout.layout')

<!-- styles stack -->
@push('styles')

@endpush
<!-- styles stack end -->

<!-- content -->
@section('content')
<form method="get" action="/auth">
  @csrf
  <input name="email" type="text" value="1@gmail.com"/>
  <input name="password" type="text" value="1"/>
  <input name="" type="submit" value=""/>
</form>
@endsection
<!-- content end -->

<!-- scripts stack -->
@push('scripts')

@endpush
<!-- scripts stack end -->
