@extends('layouts.layout')
@section('titulo', "Productos")
@section('css')

@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Productos</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de productos mas vendidos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($usuario=Auth::user()->admin==1)
                            <div class="col-md-3 text-nowrap">
                                <a class="btn btn-primary btn-sm" href="/registrarproducto" type="button">Agregar Producto</a>
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
                                        <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Buscar">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTabla">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Costo Compra</th>
                                    <th>Costo Venta</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Productos en Stock</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="tbproducto">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" style="margin-top: 3%">
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Categorias más vendidas</p>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Categoria 1<span class="float-right">100%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Categoria 2<span class="float-right">80%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Categoria 3<span class="float-right">60%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Categoria 4<span class="float-right">40%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Categoria 5<span class="float-right">20%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 font-weight-bold">Productos más vendidos</p>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Producto 1<span class="float-right">100%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Producto 2<span class="float-right">80%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Producto 3<span class="float-right">60%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Producto 4<span class="float-right">40%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40%</span></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Producto 5<span class="float-right">20%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20%</span></div>
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
<div id="modal-open">
    <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal" aria-labelledby="exampleModalLabel" style="height: 825px;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;">Apertura de Caja</h4><input type="text" style="width: 211px;" hidden /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-primary" data-dismiss="modal" type="button">Aceptar</button></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('/js/producto.js')}}"></script>
@endsection