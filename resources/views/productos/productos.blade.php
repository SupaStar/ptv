@extends('layouts.layout')
@section('titulo', "Productos")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Productos</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de productos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input hidden id="idadmin" value="{{Auth::user()->admin}}">
                            @if($usuario=Auth::user()->admin==1)
                            <div class="col-md-3 text-nowrap">
                                <a class="btn btn-primary btn-sm" href="/registrarproducto" type="button">Agregar Producto</a>
                            </div>
                            @endif
                                <div class="col-md-3 text-nowrap">
                                    <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                         <label>Filtrar<select class="form-control form-control-sm custom-select custom-select-sm" style="margin-left: 5px">

                                                <option selected value="5">Todos los productos</option>
                                                <option value="1">Productos por caducar</option>
                                                <option value="2">Productos por terminarse</option>
                                                <option value="3">Productos sin existencia</option>
                                                <option value="4">Productos Inactivos</option>
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
                            <table id="dtproductos" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Costo Compra</th>
                                    <th>Costo Venta</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Caducidad</th>
                                    <th>Productos en Stock</th>
                                    <th>Estado</th>
                                    @if($usuario=Auth::user()->admin==1)
                                    <th>Acciones</th>
                                    @endif
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
                        <canvas id="grafica"></canvas>
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
</div>
<div id="modal-open">
    <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal1" aria-labelledby="exampleModalLabel" style="height: 825px;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center">
                    <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;">Desea desactivar la venta del producto?</h4><input id="idprod" type="text" style="width: 211px;" hidden /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button id="desactivaproducto" class="btn btn-primary" data-dismiss="modal" type="button">Aceptar</button></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('/js/producto.js')}}"></script>
<script>
    @if()
        @endif
</script>
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script>
        var productos = [];
        var valores = [];
        var partes = [];
        var cont;
        $.ajax({
            url: '/masvendidos',
            method: 'get',
            data:{
                id:"grafica",
            }
        }).done(function (response){
                for(var x= 0; x<=response.length;x++){
                    cont = response [x];
                    partes  = cont.split(";");
                    productos [x] = partes [0];
                    valores [x]= partes [1];
                    console.log(productos[x]);
                    console.log(valores[x]);
                }
                generar();
            }
        );

        function generar (){
            var ctx = document.getElementById('grafica').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productos,
                    datasets: [{
                        label: 'Productos más vendidos',
                        data: valores ,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }


    </script>
@endsection