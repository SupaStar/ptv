@extends('layouts.layout')
@section('titulo', "Categorias")
@section('css')

@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Categorías</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Informacion de productos y categorías</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($usuario=Auth::user()->admin==1)
                                <div class="col-md-3 text-nowrap">
                                    <button class="btn btn-primary btn-sm" type="submit">Agregar categoría</button>
                                </div>
                                @endif
                                <div class="col-md-3 text-nowrap">
                                    <div id="mostrar" class="dataTables_length" aria-controls="dataTable">
                                       </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                        </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">
                                        <label>
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Buscar">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTabla">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>

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
@endsection
@section('js')