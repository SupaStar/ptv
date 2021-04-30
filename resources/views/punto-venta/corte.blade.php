@extends('layouts.layout')
@section('titulo', "Corte de Caja")
@section('css')

@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Corte de Caja</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"></p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="tb">
                                <thead>
                                <tr>
                                    <th>N° de Venta</th>
                                    <th>Empleado</th>
                                    <th>Total</th>
                                    <th>Tipo de pago</th>
                                    <th>Hora</th>
                                    <th>Detalles</th>
                                </tr>
                                </thead>
                                <tbody id="tbventasdia">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" style="margin-top: 3%">
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="py-3" align="center">
                                <p class="text-primary m-0 font-weight-bold">Saldo inicial </p>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-left no-gutters">
                                    <div class="col-xl-9 offset-xl-1 mr-2">
                                        @foreach($apertura as $ap)
                                        <input value="${{$ap->monto_inicio}}" disabled id="saldoinicial" type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Saldo inicial">
                                        @endforeach
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Detalles Compra -->
                    <div class="modal fade" id="modal-detalles-compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalles de la Venta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-text" id="DVnumVenta"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-text" id="DVempleado"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-text" id="DVtotalVenta"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-text" id="DVtipoPago"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="offset-2 col-md-8">
                                                <label class="form-text" id="DVhoraCompra"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="container">
                                                <table id="tbProductosDetallados" class="table table-sm table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th >Cantidad</th>
                                                        <th >Total</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbProductosDetalladosP">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal Detalles Compra -->
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="py-3" align="center">
                                <p class="text-primary m-0 font-weight-bold">Saldo de corte de caja</p>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-left no-gutters">
                                    <div class="col-xl-2 ">
                                        <label class="form-text">Efectivo:</label>
                                    </div>
                                    <div class="col-xl-8 mr-2">
                                        <input disabled id="saldocorteEfectivo" type="text" class="form-control form-control-sm" aria-controls="dataTable">
                                    </div>
                                    <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                </div>
                                <div class="row align-items-left no-gutters">
                                    <div class="col-xl-2 ">
                                        <label class="form-text">Tarjeta:</label>
                                    </div>
                                    <div class="col-xl-8 mr-2">
                                        <input disabled id="saldocorteTarjeta" type="text" class="form-control form-control-sm" aria-controls="dataTable">
                                    </div>
                                    <div class="col-auto"><i class="fas fa-credit-card fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                </div>
                                <div class="py-3" align="center">
                                    <h3 class="text-success m-0 font-weight-bold" id="texto-total"></h3>
                                </div>
                               </div>
                            <button class="btn btn-primary" type="button" id="btnCerrarCaja" href="{{_c("ESTADO_CAJA") == "cerrada" ? route('cambiar-estado-caja') : route('cerrar-caja')}}"{{_c("ESTADO_CAJA") == "cerrada" ? "btnCambiarEstadoCaja" : "btnCerrarCaja"}}">Cerrar Caja</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
@endsection
@section('js')
    <script src="/js/bootbox.all.min.js"></script>
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script src="/js/cortecaja.js"></script>
    <script src="{{asset('/js/venta-dia.js')}}"></script>
@endsection