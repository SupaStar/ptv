@extends('layouts.layout')
@section('titulo', "Ventas de la semana")
@section('css')

@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Ventas de la semana: {{\Carbon\Carbon::now()->subDay(7)->format("d-m-Y")}} al {{\Carbon\Carbon::now()->format("d-m-Y")}}</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"></p>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3 text-nowrap">


                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTabla">
                                    <thead>
                                    <tr>
                                        <th>N° de Venta</th>
                                        <th>Empleado</th>
                                        <th>Fecha de venta</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbventash">
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
            <script src="{{asset('js/venta-semana.js')}}"></script>
@endsection