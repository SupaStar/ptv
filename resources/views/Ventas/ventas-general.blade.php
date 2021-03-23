@extends('layouts.layout')
@section('titulo', "Ventas Generales")
@section('css')

    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Ventas generales</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"></p>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3 text-nowrap">
                                <div id="filtrar" class="dataTables_length" aria-controls="dataTable">

                                    <label>Fecha de inicio: <input id="start" class="form-control" type="date"></label>
                                    <label>Fecha de Final: <input disabled id="finish" class="form-control" type="date"></label>

                                </div>

                        </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered table-striped my-0" id="tbventasgenerales">
                                    <thead>
                                    <tr>
                                        <th>N° de Venta</th>
                                        <th>Empleado</th>
                                        <th>Fecha de venta</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbventas">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/ventas.js')}}"></script>

            <script src="{{asset('assets/js/datatables.min.js')}}"></script>
@endsection