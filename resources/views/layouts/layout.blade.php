<!DOCTYPE html>
<html lang="es-419">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/img/logo.png')}}" >
    <title>G&P Farmacias - @yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('assets/css/alertify.min.css')}}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{asset('assets/css/themes/default.min.css')}}"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="{{asset('assets/css/themes/semantic.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome5-overrides.min.css')}}">

    @yield('css')
</head>

<body id="page-top">
<div id="wrapper">
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #4e73df;">
        <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="/">
                <div class="sidebar-brand-icon"><img style="width: 100%;filter: brightness(200%) contrast(124%) saturate(200%);" src="{{asset('assets/img/logo.png')}}"></div>
               
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link active" href="/"><i class="fas fa-tachometer-alt"></i><span>Inicio</span></a></li>
                @if($usuario=Auth::user()->admin==1)
                <li class="nav-item dropdown"><a class="nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-user"></i>Usuarios</a>

                    <div class="dropdown-menu"><a class="dropdown-item" href="/perfil">Mi perfil</a>
                        <a class="dropdown-item" href="/usuarios">Usuarios</a></div>
                 </li>
                @endif

                <li class="nav-item dropdown"><a class="nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-table"></i><span>Productos</span></a>
                    <div class="dropdown-menu"><a class="dropdown-item" href="/productos">Stock de Productos</a><a class="dropdown-item" href="/categorias">Categorias</a></div>
                </li>
                @if($usuario=Auth::user()->admin==1)
                <li class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#"><i class="fa fa-money"></i><span>Ventas</span></a>
                    <div class="dropdown-menu"><a class="dropdown-item" href="/ventasgeneral">Ventas General</a><a class="dropdown-item" href="/ventashoy">Ventas de hoy</a></div>
                </li>
                <li class="nav-item dropdown"><a aria-expanded="false" data-toggle="dropdown" class="nav-link" href="#"><i class="fa fa-edit"></i><span>Otros</span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route("notas.mostrar")}}">Notas</a>
                        <a class="dropdown-item" href="/ventashoy">Configuración</a>
                    </div>
                </li>
                @endif

            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                    <ul class="navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter">{{$productos=App\Producto::orderBy("estado","DESC")->where("stock","<=",10)->count()}}</span><i class="fas fa-chart-line fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">Productos por terminarse</h6>
                                    @foreach( $productos=App\Producto::orderBy("estado","DESC")->where("stock","<=",10)->get() as $product)
                                    <a class="dropdown-item d-flex align-items-center" href="/editarproducto/{{$product->id}}">
                                        <div class="mr-3">
                                            <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div><span class="small text-gray-500">Su stock actual es de: {{$product->stock}} productos</span>
                                            <p>El producto: {{$product->nombre}}, con código: {{$product->codigo}}, esta apunto de terminarse, presione la notificación si desea agregar producto</p>
                                        </div>
                                    </a>
                                    @endforeach
                                    </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge badge-danger badge-counter">{{$productos=App\Producto::whereDate("fecha_caducidad",">=",Carbon\Carbon::now()->format('Y-m-d'))->whereDate("fecha_caducidad","<=",Carbon\Carbon::now()->addDays(15)->format('Y-m-d'))->count()}}</span><i class="far fa-clock fa-fw"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list animated--grow-in">
                                    <h6 class="dropdown-header">Productos por caducar</h6>
                                  @foreach($productos=App\Producto::whereDate("fecha_caducidad",">=",Carbon\Carbon::now()->format('Y-m-d'))->whereDate("fecha_caducidad","<=",Carbon\Carbon::now()->addDays(15)->format('Y-m-d'))->get() as $us)
                                    <a class="dropdown-item d-flex align-items-center" href="/editarproducto/{{$us->id}}">
                                        <div class="mr-3">
                                            <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                        </div>
                                        <div><span class="small text-gray-500">Caduca el dia: {{$us->fecha_caducidad}}</span>
                                            <p>El producto: {{$us->nombre}}, con código: {{$us->codigo}}, esta apunto de caducar, presione la notificación si desea editarlo</p>
                                        </div>
                                    </a>
                                    @endforeach
                                     </div>
                            </div>
                        </li>

                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow">
                            <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">{{$usuario=Auth::user()->name}}</span><img class="border rounded-circle img-profile" src="../uploads/fotoperfil/{{$usuario=Auth::user()->id."fotoperfil.jpg"}}"></a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><div class="dropdown-divider"></div><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Cerrar Sesión</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
           @yield('contenido')
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Farmacias G&P 2021</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<input type="hidden" id="urlCambiarEstadoCaja" value="{{route('do-cambiar-estado-caja')}}">
@include('layouts.resurtimiento-modal')

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>

<script src="{{asset('assets/js/script.min.js')}}"></script>
<script src="{{asset('assets/js/alertify.min.js')}}"></script>
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
