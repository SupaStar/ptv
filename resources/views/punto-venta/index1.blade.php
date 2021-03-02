@extends('layouts.layout')
@section('titulo', "Punto de venta")
@section('css')

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Inicio</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4 offset-xl-2 mb-4"><a href="#">
                    <div class="card shadow border-bottom-primary py-2">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center no-gutters">
                                <div class="col-xl-4 mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);"></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>Cobrar</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a></div>
            <div class="col-md-6 col-xl-4 offset-xl-0 mb-4"><a href="#">
                    <div class="card shadow border-bottom-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-7 offset-xl-2 mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);"></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>Corte de Caja</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a></div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-xl-6 offset-xl-0">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold m-0">Productos por caducar</h6>
                        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Stock</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cell 1</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                </tr>
                                <tr>
                                    <td>Cell 3</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-6 offset-xl-0">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary font-weight-bold m-0">Productos por terminarse</h6>
                        <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                            <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Stock</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Cell 1</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                    <td>Cell 2</td>
                                </tr>
                                <tr>
                                    <td>Cell 3</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                    <td>Cell 4</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary font-weight-bold m-0">Mejores Categorías&nbsp;</h6>
                    </div>
                    <div class="card-body">
                        <div><canvas data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Antibioticos&quot;,&quot;Sin receta&quot;,&quot;Sueros&quot;,&quot;Electrolitos&quot;,&quot;Mascarillas&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;#3749aa&quot;,&quot;borderColor&quot;:&quot;#000000&quot;,&quot;data&quot;:[&quot;50&quot;,&quot;60&quot;,&quot;80&quot;,&quot;100&quot;,&quot;3&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-left-primary py-2" style="background: transparent;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Ventas(hoy)</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>$40,000</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-line-chart fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-left-success py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Ventas(semanal)</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>$215,000</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-chart-area fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-left-danger py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);">caja</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>$215,000</span></div>
                                    </div>
                                    <div class="col-auto"><i class="far fa-money-bill-alt fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-left-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>n° de productos</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span>18</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fa fa-shopping-cart fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-open">
        <div class="modal fade" role="dialog" tabindex="-1" id="exampleModal" aria-labelledby="exampleModalLabel" style="height: 825px;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center justify-content-center">
                        <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;">Apertura de Caja</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body justify-content-center">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-2" style="width: 242px;">
                                <h1 style="font-size: 20px;color: rgb(0,0,0);">Fecha:</h1>
                            </div>
                            <div class="col-xl-7"><input style="width: 100%;" type="date"></div>
                        </div>
                        <div class="row justify-content-center align-items-center" style="width: 490px;">
                            <div class="col-xl-2" style="width: 242px;">
                                <h1 style="font-size: 20px;color: rgb(0,0,0);">Inicial:</h1>
                            </div>
                            <div class="col-xl-7"><input type="number" style="width: 100%;"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button class="btn btn-primary" data-dismiss="modal" type="button">Aceptar</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
