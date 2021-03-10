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
                            <table class="table my-0" id="dataTabla">
                                <thead>
                                <tr>
                                    <th>N° de Venta</th>
                                    <th>Producto</th>
                                    <th>Empleado</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                        <input type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Saldo inicial">
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="py-3" align="center">
                                <p class="text-primary m-0 font-weight-bold">Saldo de corte</p>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-left no-gutters">
                                    <div class="col-xl-9 offset-xl-1 mr-2">
                                        <input type="text" class="form-control form-control-sm" aria-controls="dataTable" placeholder=  "Saldo corte">
                                    </div>
                                    <div class="col-auto"><i class="fas fa-cash-register fa-2x text-gray-300" style="margin-left: 10px"></i></div>
                                </div>
                                <button class="btn btn-primary" type="button" id="btnCerrarCaja" href=href="{{_c("ESTADO_CAJA") == "cerrada" ? route('cambiar-estado-caja') : route('cerrar-caja')}}"{{_c("ESTADO_CAJA") == "cerrada" ? "btnCambiarEstadoCaja" : "btnCerrarCaja"}}">Cerrar Caja</button>
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
    <script>
        $(document).ready(function ()
        {

            $('#btnCerrarCaja').on("click", function(e){
                e.preventDefault();
                var href = $(this).attr("href");
                bootbox.confirm({
                    message: "¿Seguro que desea cerrar la caja?",
                    locale: "es",
                    callback: function(result){
                        if(result)
                            location.href = href;
                    }
                });
            });
        })
    </script>
@endsection