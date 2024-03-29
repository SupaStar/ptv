@extends('layouts.layout')
@section('titulo', "Usuarios")
@section('css')

    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <input hidden id="idadmin" value="{{Auth::user()->admin}}">
                            <p class="text-primary m-0 font-weight-bold">Información de usuarios</p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 text-nowrap">
                                    <a class="btn btn-primary btn-sm" href="/agregarusuario" type="button">Agregar Empleado</a>

                                </div>

                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered my-0" id="tablausuarios" style="width: 100%; !important;">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Nombre de usuario</th>
                                        <th>Tipo de empleado</th>
                                        <th>Correo</th>
                                        <th>Estado</th>
                                        @if($usuario=Auth::user()->admin==1)
                                            <th>Acciones</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <div id="modal-open">
        <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal2" aria-labelledby="exampleModalLabel" style="height: 825px;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center justify-content-center">
                        <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;" id="usuarionombremodal"></h4><input id="idus" type="text" style="width: 211px;" hidden /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button id="desactivausuario" class="btn btn-primary" data-dismiss="modal" type="button">Aceptar</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/js/usuarios.js"></script>

    <script src="{{asset('assets/js/datatables.min.js')}}"></script>

@endsection