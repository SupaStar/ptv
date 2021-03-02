@extends('layouts.main')
@section('titulo','Login')
@section('contenido')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <link rel="stylesheet" href="/css/login.css">

</head>

<body>
<div class="container-fluid">
    <div class="row main-content bg-success text-center">
        <div class="col-md-4 text-center company__info">
            <span class="company__logo"><h1><span class="fa fa-ambulance"></span></h1></span>
            <h4 style="font-size: 20px; font-family: Nunito">Your Pharmacy</h4>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
            <div class="container-fluid">
                <h2 class="titulo">Iniciar Sesión</h2>
                <form class="form-group" method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <input style="font-family: Nunito" id="email" type="email" name="email" class="form__input"
                               placeholder="Correo electronico" value="{{ old('email') }}" required
                               autocomplete="email">
                    </div>
                    <div class="row">

                        <input style="font-family: Nunito" id="password" type="password" class="form__input"
                               name="password" placeholder="Contraseña" autocomplete="current-password" required>
                    </div>
                    <div class="rem">
                        <input type="checkbox" name="remember_me" id="remember_me" class="">
                        <label for="remember_me"> Recuerdame!</label>
                    </div>

                        <input style="font-family: Nunito" type="submit" value="Ingresar" class="btn ">

                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>
@endsection
