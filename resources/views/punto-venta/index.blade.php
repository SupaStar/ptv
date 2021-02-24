@extends('layouts.main')
@section('titulo', "Punto de venta")
@section('css')
<link rel="stylesheet" href="/css/pdv.css">
@endsection
@section('contenido')
<div class="container-fluid">
    @if(_c("ESTADO_CAJA") == "cerrada")
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h6 class="text-center">La caja está cerrada y no podrá realizar ventas</h2>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-10">
            <input type="text" autocomplete="off" class="form-control" id="busqueda" placeholder="Búsqueda" autofocus>
        </div>
        <div class="col-sm-2">
            <button class="btn mt-sm-0 mt-4 btn-block btn-success" id="btnBuscar">
                <i class="material-icons">
                    search
                </i>
            </button>
        </div>
    </div>
    <button class="mt-3 btn btn-block btn-secondary btn-cobrar d-lg-none">
        Cobrar (F10)
    </button>
    <section class="cuenta">
        <div class="total-cuenta container-fluid">
            <div class="row">
                <div class="col-8"><b>Total</b></div>
                <div class="col-4"><b>$0.00</b></div>
            </div>
        </div>
    </section>
</div>
<input type="hidden" id="ruta-buscar" value="{{route('buscar')}}">
<input type="hidden" id="ruta-cobrar" value="{{route('cobrar')}}">
@include('layouts.modal-pago')
@endsection
@section('js')
<script src="/js/pdv.js"></script>
@endsection