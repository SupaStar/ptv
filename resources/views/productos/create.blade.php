@extends('layouts.main')
@section('titulo', "Productos")
@section('contenido')
<form class="col-6 offset-3" action="{{route("productos.store")}}" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col-12 form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="">Compra</label>
            <input type="number" name="compra" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="">Venta</label>
            <input type="number" name="venta" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="">Stock</label>
            <input type="number" name="stock" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>
@endsection
@section('js')

@endsection