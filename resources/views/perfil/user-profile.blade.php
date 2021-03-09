@extends('layouts.layout')
@section('titulo', "Usuario")
@section('css')

@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4" style="margin-top: 10px">Perfil de usuario</h3>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3" align="center">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                            Editar información
                                        </p>
                                    </div>
                                    <div class="card-body" align="center">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <img class="rounded-circle mb-3 mt-4" src="assets/img/dogs/image2.jpeg" width="100" height="100">
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary btn-sm" type="button">
                                                    <i class="fa fa-camera" style="margin-right: 10px; margin-left: 2px" aria-hidden="true"></i>
                                                    Cambiar foto de perfil
                                                </button>
                                            </div>
                                        </div>
                                        <form action="/actualizarperfil" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                        <label for="nombre"><strong>Nombre</strong></label>
                                                        <input class="form-control" type="text" id="nombrep" name="nombree" placeholder="Nombre">
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
                                            <div class="form-group">
                                                <button id="guardaperfil" class="btn btn-primary btn-sm" type="submit">
                                                    <i class="fa fa-floppy-o" style="margin-right: 10px; margin-left: 2px"  aria-hidden="true"></i>
                                                    Guardar cambios
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
@endsection
@section('js')
    <script src="/js/perfil.js"></script>
@endsection
