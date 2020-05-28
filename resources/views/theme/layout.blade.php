<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <title>@yield('titulo','Inicio') | Panel administrador</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{asset("assets/theme/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{asset("assets/theme/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{asset("assets/theme/css/ionicons.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{asset("assets/theme/css/AdminLTE.css")}}" rel="stylesheet" type="text/css" />

        {{-- <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}"> --}}

        @yield("styles")
</head>
<body class="skin-black">

    <!-- Inicio Header -->
    @include("theme/header")
    <!-- Fin Header -->
    <div class="wrapper row-offcanvas row-offcanvas-left">
        
        <!-- Inicio Aside -->
        @include("theme/aside")
        <!-- Fin Aside -->

        <aside class="right-side">
            <!-- Content Header (Page header) -->
            @yield("contenido")
        </aside>

    </div>


    <!--Inicio Footer -->
    @include("theme/footer")
    <!-- Fin Footer -->

    <!-- jQuery 2.0.2 -->
    <script src="{{asset("assets/theme/js/jquery-2.0.2.min.js")}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset("assets/theme/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/theme/js/AdminLTE/app.js")}}" type="text/javascript"></script>
</body>
</html>