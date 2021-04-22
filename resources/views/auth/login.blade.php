<!DOCTYPE html>
<html lang="es-419">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('titulo')Login - PTV</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    @yield('css')
</head>


<body class="bg-gradient-primary">
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-9 col-lg-12 col-xl-10" >
            <div class="card shadow-lg o-hidden border-0 my-5" >
                <div class="card-body p-0" >
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image"
                                 style="background-image: url('https://e00-expansion.uecdn.es/assets/multimedia/imagenes/2020/02/22/15823940962251.jpg')"> </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Bienvenido de nuevo!</h4>
                                </div>
                                <form class="user" method="post" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input class="form-control form-control-user" type="email"
                                                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                                                   placeholder=" Correo electronico" name="email">
                                    </div>
                                    <div class="form-group"><input class="form-control form-control-user"
                                                                   type="password" id="exampleInputPassword"
                                                                   placeholder="Contraseña" name="password"></div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check"><input class="form-check-input custom-control-input"
                                                                           type="checkbox" id="formCheck-1"><label
                                                        class="form-check-label custom-control-label" for="formCheck-1">Recordar!</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                                        Ingresar
                                    </button>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Olvidaste tu contraseña?</a>
                                </div>
                                <div class="user">
                                    <a hidden class="btn btn-primary btn-block text-white btn-user user"  href="{{ route('register') }}" style="border-radius: 19px; margin-top: 10px">
                                        Registrarme
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script async data-id="77747" src="https://cdn.widgetwhats.com/script.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.min.js"></script>
@yield('js')


</body>

</html>
