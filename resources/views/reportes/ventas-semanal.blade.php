@extends('layouts.layout')
@section('titulo',"Registro")
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Periodo de ventas</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Informacion de ventas en determinado tiempo</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
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
                                    <div class="dataTables_length" aria-controls="dataTable">
                                        <label for="inicio">Inicio<input class="form-control form-control-sm custom-select custom-select-sm" type="date" id="inicio" name="inicio" style="margin-left: 5px"></input></label></div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div class="dataTables_length" aria-controls="dataTable">
                                        <label for="final">Final<input class="form-control form-control-sm custom-select custom-select-sm" type="date" id="final" name="final" style="margin-left: 5px"></input></label></div>
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
                                        <th>Cantidad</th>
                                        <th>Compra</th>
                                        <th>Venta</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Producto 1</td>
                                        <td>120</td>
                                        <td>Principal</td>
                                        <td>33</td>
                                    </tr>
                                    <tr>
                                        <td>Producto 2</td>
                                        <td>19</td>
                                        <td>Principal</td>
                                        <td>33</td>
                                    </tr>
                                    <tfoot>
                                    <tr>
                                        <td><strong>Nombre</strong></td>
                                        <td><strong>Cantidad</strong></td>
                                        <td><strong>Compra</strong></td>
                                        <td><strong>Venta</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" style="margin-top: 3%">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="py-3" align="center">
                                    <p class="text-primary m-0 font-weight-bold"> VENTAS (HOY) </p>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-left no-gutters">
                                        <div class="col-xl-9 offset-xl-1 mr-2">
                                            <input type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Ventas (hoy)">
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="py-3" align="center">
                                    <p class="text-primary m-0 font-weight-bold">VENTAS (SEMANAL)</p>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-left no-gutters">
                                        <div class="col-xl-9 offset-xl-1 mr-2">
                                            <input type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Ventas (semanal)">
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300" style="margin-left: 10px"></i></div>
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

