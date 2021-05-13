@extends('layouts.layout')
@section('titulo', "Editar Producto")
@section('css')
@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Editar productos</h3>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Editar Producto: {{$producto->nombre}}</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="/actualizarproducto" method="post" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="id"><strong>ID</strong></label>
                                                        <input hidden value="{{$producto->id}}" class="form-control" type="text" id="id" name="id">
                                                        <input disabled value="{{$producto->id}}" class="form-control" type="text" id="ids" name="ids">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="nombre"><strong>Nombre</strong></label>
                                                        {{ csrf_field() }}
                                                        <input value="{{$producto->nombre}}" class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="compra"><strong>Compra</strong></label>
                                                        <input value="{{$producto->compra}}" class="form-control" type="number" id="compra" name="compra" placeholder="Compra">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="venta"><strong>Venta</strong></label>
                                                        <input value="{{$producto->venta}}" class="form-control" type="number" id="venta" name="venta" placeholder="Venta">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="stock"><strong>Stock</strong></label>
                                                        <input value="{{$producto->stock}}" class="form-control" type="number" id="stock" name="stock" placeholder="Stock">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="fecha_caducidad"><strong>Fecha de caducidad</strong></label>
                                                        <input value="{{$producto->fecha_caducidad}}" class="form-control" type="date" id="fecha_caducidad" name="fecha_caducidad" placeholder="Fecha de caducidad">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="codigo"><strong>Código</strong></label>
                                                        <input value="{{$producto->codigo}}" class="form-control" type="text" id="codigo" name="codigo" placeholder="Código">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="descripcion"><strong>Descripción</strong></label>
                                                        <input value="{{$producto->descripcion}}" class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Descripción">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="categoria"><strong>Categoria</strong></label>
                                                        <select id="idcategoria" name="idcategoria" required class="form-control" required >
                                                            <option disabled>Seleccion una categoria</option>

                                                            @foreach($categoria as $categoria)
                                                                @if($categoriap->count()==0)

                                                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>

                                                            @else
                                                                @foreach($categoriap as $cp)

                                                                    <option value="{{$categoria->id}}"  {!! $cp->id_categoria==$categoria->id ? "selected" : "" !!}>{{$categoria->nombre}}</option>

                                                                @endforeach

                                                            @endif
                                                            @endforeach



                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="estado"><strong>Estado</strong></label>
                                                        <select class="form-control" required id="estado" name="estado">
                                                            <option selected disabled>Seleccione un estado</option>
                                                            @if($producto->estado=="Activo")
                                                        <option selected value="1" >Activo</option>
                                                                <option value="0">Inactivo</option>

                                                            @else
                                                            <option selected value="0">Inactivo</option>
                                                                <option value="1" >Activo</option>
                                                                @endif
                                                        </select>   </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm" type="submit">
                                                    <i class="fa fa-floppy-o" style="margin-right: 10px; margin-left: 2px"  aria-hidden="true"></i>
                                                    Guardar Producto
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
@endsection