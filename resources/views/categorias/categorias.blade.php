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
                                <div class="col-md-3 text-nowrap">
                                    <button class="btn btn-primary btn-sm" type="submit">Agregar categoría</button>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="mostrar" class="dataTables_length" aria-controls="dataTable">
                                        <label>Mostrar<select class="form-control form-control-sm custom-select custom-select-sm" style="margin-left: 5px">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                        <label>Filtrar<select class="form-control form-control-sm custom-select custom-select-sm" style="margin-left: 5px">
                                                <option value="" selected="Selecciona">Selecciona</option>
                                                <option value="caducidad">Categoria 1</option>
                                                <option value="stock">Categoria 2</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-3">
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
                                        <th>Categoria</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Producto 1</td>
                                        <td>Categoria 1</td>
                                    </tr>
                                    <tr>
                                        <td>Producto 2</td>
                                        <td>Categoria 2</td>

                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td><strong>Nombre</strong></td>
                                        <td><strong>Categoria</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Ver 1 a 10 de 30</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
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