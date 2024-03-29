@extends('layouts.layout')
@section('titulo', "Agregar nuevo usuario")
@section('css')

@endsection
@section('contenido')


    <div class="col-md-6 offset-md-3" style="max-width: 50%;">
        <div class="card shadow mb-3" align="center">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    Agregar Usuario
                </p>
            </div>
            <form action="registrarusuario" method="post" enctype="multipart/form-data">
                <div class="card-body" align="center">
                    <div class="mb-3">
                        <div class="mb-3">
                            <img class="rounded-circle mb-3 mt-4" src="uploads/fotoperfil/default.png" width="100" height="100">
                        </div>
                        <div class="mb-3">

                            <i class="fa fa-camera" style="margin-right: 10px; margin-left: 2px" aria-hidden="true"> <input accept="image/png, image/jpeg, image/jpg" id="fotoperfil" name="fotoperfil" class="form-control" type="file"></i>


                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                <label for="nombre"><strong>Nombre</strong></label>
                                {{ csrf_field() }}
                                <input required class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                <label for="apellido"><strong>Apellido</strong></label>
                                <input required class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                <label for="nombreUsuario"><strong>Nombre de usuario</strong></label>
                                <input required class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="user.name">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                            <label for="tipoEmpleado"><strong>Tipo de empleado</strong></label>
                            <select required id="tipoEmpleado" name="tipoEmpleado" class="form-control">
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
                                <input required class="form-control" type="email" id="correo" name="correo" placeholder="correo@mail.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                <label for="contrasenia"><strong>Contraseña</strong></label>
                                <input required class="form-control" type="password" id="contrasenia" name="contrasenia" placeholder="Ingrese una contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                <label for="estado"><strong>Estado</strong></label>
                                <select id="estado" name="estado" class="form-control" required id="estado">
                                    <option selected value="0">Desactivado</option>
                                    <option value="1">Activado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="guardaperfil" class="btn btn-primary btn-sm" type="submit">
                            <i class="fa fa-floppy-o" style="margin-right: 10px; margin-left: 2px"  aria-hidden="true"></i>
                            Guardar Usuario
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
