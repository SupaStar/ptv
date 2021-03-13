@extends('layouts.main')
@section('titulo',"Registro")
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        {{csrf_field()}}


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="nombre"><strong>Nombre</strong></label>
                                            <input class="form-control" type="text" id="nombrep" name="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="apellido"><strong>Apellido</strong></label>
                                            <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="nombreUsuario"><strong>Nombre de usuario</strong></label>
                                            <input class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="user.name">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                        <label for="tipoEmpleado"><strong>Tipo de empleado</strong></label>
                                        <select id="tipoEmpleado" name="tipoEmpleado" class="form-control">
                                            <option selected disabled value="Selecciona">Selecciona</option>
                                            <option value="1">Administrador</option>
                                            <option value="0">Empleado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="correo"><strong>Correo</strong></label>
                                            <input class="form-control" type="email" id="correo" name="correo" placeholder="correo@mail.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="password1"><strong>Contraseña</strong></label>
                                            <input class="form-control" type="password" id="password1" name="password1" placeholder="Contraseña">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                            <label for="password2"><strong>Confirmar contraseña</strong></label>
                                            <input class="form-control" type="password" id="password2" name="password2" placeholder="Confirmar contraseña">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                                <a href="{{route("login")}}">Ya tengo cuenta</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
