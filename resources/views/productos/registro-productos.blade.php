@extends('layouts.layout')
@section('titulo', "Usuario")
@section('css')

@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Productos</h3>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">Registro de productos</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="nombre"><strong>Nombre</strong></label>
                                                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="compra"><strong>Compra</strong></label>
                                                        <input class="form-control" type="number" id="compra" name="compra" placeholder="Compra">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="venta"><strong>Venta</strong></label>
                                                        <input class="form-control" type="number" id="venta" name="venta" placeholder="Venta">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="stock"><strong>Stock</strong></label>
                                                        <input class="form-control" type="number" id="stock" name="stock" placeholder="Stock">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="fecha_caducidad"><strong>Fecha de caducidad</strong></label>
                                                        <input class="form-control" type="date" id="fecha_caducidad" name="fecha_caducidad" placeholder="Fecha de caducidad">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="codigo"><strong>Código</strong></label>
                                                        <input class="form-control" type="text" id="codigo" name="codigo" placeholder="Código">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="descripcion"><strong>Descripción</strong></label>
                                                        <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Descripción">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm" type="submit">Registrar</button>
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