@extends('layouts.layout')
@section('titulo', "Productos")
@section('contenido')
<div class="container-fluid">
<div class="row mt-5">
    <div class="col-12">
        <table class="table table-striped table-bordered responsive nowrap" id="tabla-producto" style="width:100%">
            <thead>
                <tr>
                    <th hidden>Folio</th>
                    <th>Nombre</th>
                    <th >Compra</th>
                    <th >Venta</th>
                    <th >Stock</th>
                    <th >Acciones</th>
                </tr>
            </thead>
            <tbody id="tbproducto">



            </tbody>
        </table>
    </div>
</div>
<input type="hidden" id="ruta-editar-precio" value="{{route('productos.editar-precio')}}">
<input type="hidden" id="ruta-editar-nombre" value="{{route('productos.editar-nombre')}}">
<input type="hidden" id="ruta-editar-stock" value="{{route('productos.editar-stock')}}">
</div>
@endsection
@section('js')
<script src="/js/es.js?v={{config("app.version")}}"></script>
<script src="/js/producto.js?v={{config("app.version")}}"></script>
@endsection