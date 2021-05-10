@extends('layouts.layout')
@section('titulo', "Configuracion")
@section('css')
@endsection
@section('contenido')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Observacion de productos</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de los avisos de stock y caducidad de los productos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if($estatus == "no")
                                    <p>No hay productos por terminar o caducar</p>
                                @endif

                                @if($estatus == "ok")
                                        <p>Productos por caducar</p>
                                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                        <table id="datatable-caducidadProductos" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>nombre</th>
                                                <th>Fecha de caducidad</th>
                                                <th>Ver</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbproducto">
                                            @foreach($fechas as $dato)
                                                <tr>
                                                    <th>{{$dato -> id}}</th>
                                                    <th>{{$dato -> nombre}}</th>
                                                    <th>{{$dato -> fecha_caducidad}}</th>
                                                    <th>
                                                        <a style="margin-right: 3px"  class="btn btn-primary editarInfo" type="button" verid="{{$dato->id}}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                        <p>Productos por terminar</p>
                                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                        <table id="datatable-Stock" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Numero de productos</th>
                                                <th>Ver</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbproducto">
                                            @foreach($stocks as $dato)
                                                <tr>
                                                    <th>{{$dato -> id}}</th>
                                                    <th>{{$dato -> nombre}}</th>
                                                    <th>{{$dato -> stock}}</th>
                                                    <th>
                                                        <a style="margin-right: 3px"  class="btn btn-primary editarInfo" type="button" verid="{{$dato->id}}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </th>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
@endsection
@section('js')
@endsection