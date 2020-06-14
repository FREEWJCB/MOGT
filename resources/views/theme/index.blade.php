<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="vw-100 vh-100">

  <div id="app">
    <app-Component></app-Component>
  </div>

  <!-- <script>
  	 $(document).ready(function(){
       $('#myModal').on('shown.bs.modal', function () {
         $('#myInput').trigger('focus')
          })
    $(".dispose-toast").click(function(){
        $(this).parent().parent().remove();
    });
          $("#myToast").toast({autohide:false})
            $("#myToast").toast('show');
    });
  </script> -->
</body>
</html>
