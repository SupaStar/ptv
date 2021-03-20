@extends('layouts.layout')
@section('titulo', "Punto de venta")
@section('css')

@endsection
@section('contenido')
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Inicio</h3>
        </div>
        <div class="row" style="">
            <div class="col-md-6 col-xl-4 offset-xl-2 mb-4"><a id="btncobrar" href="/cobrar">
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
            <div class="col-md-6 col-xl-4 offset-xl-0 mb-4"><a id="btnCerrarCajas" href="/corte">

                    <div class="card shadow border-bottom-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-7 offset-xl-2 mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);"></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>   {{_c("ESTADO_CAJA") == "cerrada" ? "Abrir caja": "Cerrar caja"}}</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a></div>
            @if($usuario=Auth::user()->admin==1)
            <div hidden id="divreabrir" style="place-content: center; !important;" class="col-md-6 col-xl-4 offset-xl-0 mb-4"><a data-toggle="modal" data-target="#exampleModal6" id="btnabrircaja">
                    <div class="card shadow border-bottom-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col-xl-7 offset-xl-2 mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);"></span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0"><span>  Reabrir Caja</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a></div>
            @endif
        </div>
        <div class="row">


        </div>
        <div class="row">

            <div class="col">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-left-primary py-2" style="background: transparent;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Ventas(hoy)</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="ventahoytotal">$</span></div>
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
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="ventasemana">$0</span></div>
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
                                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span style="color: rgb(231,74,59);">Caja inicial</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="cajainicio">$0</span></div>
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
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="nproductos"></span></div>
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
                            <div class="col-xl-7">
                                <div class="input-group mb-3" style="margin-bottom: 15px;margin-top: 10px;">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar-times-o" style="font-size: 24px;"></i></span></div><input disabled id="inputabrircaja" style="width: 211px;">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center" style="width: 490px;">
                            <div class="col-xl-2" style="width: 242px;">
                                <h1 style="font-size: 20px;color: rgb(0,0,0);">Inicial:</h1>
                            </div>
                            <div class="col-xl-7">
                                <div class="input-group mb-3" style="margin-bottom: 15px;margin-top: 10px;">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money" style="font-size: 24px;"></i></span></div><input required id="cajainicial" value="0" min="0" type="number" style="width: 211px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center"><button class="btn btn-primary" data-dismiss="modal" id="btnaceptarcaja" type="button">Aceptar</button></div>
                </div>
            </div>
        </div>
    </div>
    @if($apertura=App\AperturaCaja::whereDate('created_at', '=', Carbon\Carbon::now()->format('Y-m-d'))->first()!=null)
    <div id="modal-open2">
        <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal6" aria-labelledby="exampleModalLabel" style="height: 825px;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center justify-content-center">
                        <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;">¿Desea reabrir la caja?</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action="/eliminacaja" method="post">
                    <div hidden class="modal-body justify-content-center">
                        <div class="row justify-content-center align-items-center" style="width: 490px;">
                                    {{ csrf_field() }}
                                    <input id="idcaja" name="idcaja" value="{{$apertura=App\AperturaCaja::whereDate('created_at', '=', Carbon\Carbon::now()->format('Y-m-d'))->first()->id}}" type="text" style="width: 211px;" hidden />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Reabrir Caja</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        @endif
        @endsection
@section('js')
    <script src="/js/bootbox.all.min.js"></script>
<script src="/js/jsindex.js"></script>
@endsection
