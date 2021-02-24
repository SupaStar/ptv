<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("titulo") - Movilib</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sc-2.0.1/datatables.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css?v={{config("app.version")}}">
    @yield("css")
</head>
</head>

<body>
    @if(session("estado"))
    <div class="notificacion alert alert-info alert-dismissible" role="alert">
        <span class="mensaje">{!!session("estado")!!}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if($errors->any())
    <div class="notificacion alert alert-danger alert-dismissible" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="container-fluid" id="main">
        <nav class="navbar navbar-expand-lg fixed-bottom navbar-light bg-light">
            <a class="navbar-brand text-center text-md-left" href="{{route('punto-venta')}}">
                <img src="/img/logo.png" style="width: 100%;" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    {{-- <li class="nav-item {{Route::currentRouteName() == "productos.index" ? "active": ""}}">
                    <a class="nav-link" href="{{route("productos.index")}}">Productos</a>
                    </li> --}}
                    {{-- <li class="nav-item {{Route::currentRouteName() == "surtimiento" ? "active": ""}}">
                    <a href="#" class="nav-link link-surtimiento">Surtimiento</a>
                    </li> --}}
                    <li class="nav-item {{Route::currentRouteName() == "productos.index" ? "active": ""}}">
                        <a href="{{route('productos.index')}}" class="nav-link">Lista de productos</a>
                    </li>
                    @auth                    
                    <li class="nav-item {{Route::currentRouteName() == "reparaciones.index" ? "active": ""}}">
                        <a href="{{route('reparaciones.index')}}" class="nav-link logout">Reparaciones</a>
                    </li>
                    @if (auth()->user()->admin)
                    <li class="nav-item dropup">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Reportes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{route('ventas.reporte')}}" class="nav-link">Ventas recientes</a>
                            <a href="{{route('ventas-history.reporte')}}" class="nav-link">Ventas en el tiempo</a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li class="nav-item">
                        <a href="{{_c("ESTADO_CAJA") == "cerrada" ? route('cambiar-estado-caja') : route('cerrar-caja')}}"
                            class="btn btn-warning {{_c("ESTADO_CAJA") == "cerrada" ? "btnCambiarEstadoCaja" : "btnCerrarCaja"}}">
                            <i class="fa fa-{{_c("ESTADO_CAJA") == "cerrada" ? "play" : "stop"}}"></i>
                            {{_c("ESTADO_CAJA") == "cerrada" ? "Abrir caja": "Cerrar caja"}}
                        </a>
                    </li>
                    @endauth
                    {{-- Para cuando tengamos login --}}
                    {{-- <li class="nav-item dropup">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </nav>
        @yield("contenido")
        <div class="modal fade" id="modal-general" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="urlCambiarEstadoCaja" value="{{route('do-cambiar-estado-caja')}}">
    @include('layouts.resurtimiento-modal')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="/js/bootbox.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/sc-2.0.1/datatables.min.js">
    </script>
    <script src="/js/main.js?v={{config("app.version")}}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(".link-surtimiento,#btn-readjuntar").on("click", function(e){
            e.preventDefault();
            $("#modal-surtimiento").modal("show");
        });
        mostrarAlerta = function(mensaje) {
            $(".js-generated").fadeOut(function() {
                $(this).remove();
            });
            $("body").append('<div class="js-generated alert alert-danger alert-dismissible notificacion" role="alert">' +
                mensaje +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button></div>');
            $(".js-generated").fadeIn();
        };
        $(document).on("click",".btnCerrarCaja", function(e){
            e.preventDefault();
            var href = $(this).attr("href");
            bootbox.confirm({
                message: "¿Seguro que desea cerrar la caja?",
                locale: "es",
                callback: function(result){
                    if(result)
                        location.href = href;
                }
            });
        });
        $("[data-toggle='tooltip']").tooltip();
        $(document).on("keypress", ".onlynumbers", function (e) {
        if ($(this).attr("data-length") != undefined) {
            if ($(this).val().length >= $(this).attr("data-length"))
                return false;
        }
        return !((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57));
    });
    </script>
    @yield('js')
</body>

</html>