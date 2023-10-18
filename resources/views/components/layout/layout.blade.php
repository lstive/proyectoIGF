<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8"/>
    <title>Document</title>
    @stack('styles')
  </head>

  <!-- content -->
  <body>
    @yield('content')
    @stack('scripts')
  </body>
  <!-- content end -->
  
</html>
