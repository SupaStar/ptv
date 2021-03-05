@extends('layouts.main')
@section('titulo', "Productos")
@section('contenido')
<div class="container-fluid">
    @auth
<div class="row">
    <div class="col-md-3">
        <a class="btn btn-success btn-block" id="btnAgregar" href="{{route("productos.create")}}">Agregar</a>
    </div>
</div>
@endauth
<div class="row mt-5">
    <div class="col-12">
        <table class="table table-striped table-bordered responsive nowrap" id="tabla-productos" style="width:100%">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    @if (auth()->user()->admin)
                    <th scope="col">Compra</th>
                    @endif
                    <th scope="col">Venta</th>
                    <th scope="col">Stock</th>
                    @if (auth()->user()->admin)
                    <th scope="col">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $dato)
                <tr data-id="{{$dato->id}}">
                    <td>{{$dato->id}}</td>
                    <td class="producto-nombre">{{$dato->nombre}}</td>
                    @if (auth()->user()->admin)
                    <td class="producto-compra" data-tipo="compra">
                        {{$dato->compra}}
                    </td>
                    @endif
                    <td class="producto-venta" data-tipo="venta">
                        {{$dato->venta}}
                    </td>
                    <td class="producto-stock">{{$dato->stock}}</td>
                    @if (auth()->user()->admin)
                    <td>
                        <a class="btn btn-danger btnEliminar">
                            <i class="fa fa-close"></i>
                            <form class="delete-form" action="{{route('productos.destroy',["id" => $dato->id])}}"
                                method="post">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                            </form>
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    @if (auth()->user()->admin)
                    <th>Compra</th>
                    @endif
                    <th>Venta</th>
                    <th>Stock</th>
                    @if (auth()->user()->admin)
                    <th>Acciones</th>
                    @endif
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<input type="hidden" id="ruta-editar-precio" value="{{route('productos.editar-precio')}}">
<input type="hidden" id="ruta-editar-nombre" value="{{route('productos.editar-nombre')}}">
<input type="hidden" id="ruta-editar-stock" value="{{route('productos.editar-stock')}}">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Fecha de Caducidad</th>
                    <th>Stock</th>
                </tr>
                </thead>
                <tbody id="tbproducto">

                </tbody>
            </table>
        </div>
</div>
@endsection
@section('js')
<script src="/js/es.js?v={{config("app.version")}}"></script>
<script src="/js/productos.js?v={{config("app.version")}}"></script>
<script src="/js/producto.js"></script>
@endsection