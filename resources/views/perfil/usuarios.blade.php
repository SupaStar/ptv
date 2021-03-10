@extends('layouts.layout')
@section('titulo', "Usuarios")
@section('css')

@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Usuarios</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Información de usuarios</p>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 text-nowrap">
                                    <a class="btn btn-primary btn-sm" href="/agregarusuario" type="button">Agregar Empleado</a>

                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                        <label>Filtrar<select class="form-control form-control-sm custom-select custom-select-sm" style="margin-left: 5px">
                                                <option value="" selected="Selecciona">Selecciona</option>
                                                <option value="1">Administrador</option>
                                                <option value="0">Empleado</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">
                                        <label>
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Buscar">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTabla">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Nombre de usuario</th>
                                        <th>Tipo de empleado</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbusuarios">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
@section('js')
    <script src="/js/usuarios.js"></script>
@endsection