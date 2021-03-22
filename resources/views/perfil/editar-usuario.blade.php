@extends('layouts.layout')
@section('titulo', "Agregar nuevo usuario")
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
                                <div class="col-md-6 offset-md-3" style="max-width: 50%;">
                                    <div class="card shadow mb-3" align="center">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">
                                                <i class="fa fa-cog" aria-hidden="true"></i>
                                                Editar Usuario: {{$usuario->name}}
                                            </p>
                                        </div>
                                        <form action="/actualizarusuario" method="post" enctype="multipart/form-data">
                                        <div class="card-body" align="center">
                                            <div class="mb-3">
                                                <div class="mb-3">
                                                    <img class="rounded-circle mb-3 mt-4" src="../uploads/fotoperfil/{{$usuario->id."fotoperfil.jpg"}}" width="100" height="100">
                                                </div>
                                                <div class="mb-3">

                                                    <i class="fa fa-camera" style="margin-right: 10px; margin-left: 2px" aria-hidden="true"> <input type="file" class="form-control" id="imgprueba" name="imgprueba" accept="image/png, image/jpeg, image/jpg"></i>

                                                </div>
                                            </div>

                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="nombre"><strong>Nombre</strong></label>
                                                            {{ csrf_field() }}
                                                            <input value="{{$usuario->id}}" class="form-control" type="text" id="id" name="id" hidden>
                                                            <input required value="{{$usuario->name}}" class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="apellido"><strong>Apellido</strong></label>
                                                            <input required value="{{$usuario->lastname}}" class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="nombreUsuario"><strong>Nombre de usuario</strong></label>
                                                            <input required value="{{$usuario->username}}" class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="user.name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                        <label for="tipoEmpleado"><strong>Tipo de empleado</strong></label>
                                                        <select required id="tipoEmpleado" name="tipoEmpleado" class="form-control">
                                                            <option selected disabled value="Selecciona">Selecciona</option>
                                                            @if($usuario->admin=1)
                                                                <option selected value="1">Administrador</option>
                                                                <option value="0">Empleado</option>
                                                            @elseif($usuario->admin=0)
                                                                <option  value="1">Administrador</option>
                                                                <option selected value="0">Empleado</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="correo"><strong>Correo</strong></label>
                                                            <input required value="{{$usuario->email}}" class="form-control" type="email" id="correo" name="correo" placeholder="correo@mail.com">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="contrasenia"><strong>Contraseña</strong></label>
                                                            <input class="form-control" type="password" id="contrasenia" name="contrasenia" placeholder="Ingrese una contraseña">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="estado"><strong>Estado</strong></label>
                                                            <select  id="estado" name="estado" class="form-control" required id="estado">
                                                                @if($usuario->estado==1)
                                                                <option value="0">Desactivado</option>
                                                                <option selected value="1">Activado</option>
                                                                    @elseif($usuario->estado==0)
                                                                        <option selected value="0">Desactivado</option>
                                                                        <option value="1">Activado</option>
                                                                @endif
                                                            </select>
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
@endsection
