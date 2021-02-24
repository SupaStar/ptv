@extends('layouts.main')
@section('titulo', "Reporte de ventas")
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    #main {
        height: auto;
        margin-top: 20px;
        margin-bottom: 50px;
    }
</style>
@endsection
@section('contenido')
<div class="row">
    <div class="col-4 offset-8">
        <input type="text" name="fechas" class="form-control">
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label for="">Ventas totales</label>
        <input type="text" class="form-control" readonly id="ventasTotales">
    </div>
    <div class="col-4">
        <label for="">Total</label>
        <input type="text" class="form-control" readonly id="total">
    </div>
    <div class="col-4">
        <label for="">Utilidad</label>
        <input type="text" class="form-control" readonly id="utilidad">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped table-bordered responsive nowrap" id="reporte" style="width:100%">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Productos</th>
                    <th>Total</th>
                    <th>Denominación</th>
                    <th>Cambio</th>
                    <th>Utilidad</th>
                    <th>Fecha / Hr</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="cuerpo">

            </tbody>
        </table>
    </div>
</div>
<input type="hidden" id="urlReportar" value="{{route("ventas.reportar")}}">
<input type="hidden" id="urlVenta" value="{{route("ventas.show")}}">
@endsection
@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="/js/reporte-ventas.js?v={{config("app.version")}}"></script>
@endsection