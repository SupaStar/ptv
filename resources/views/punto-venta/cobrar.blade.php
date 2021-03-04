@extends('layouts.layout')
@section('titulo', "Punto de venta")
@section('css')

@endsection
@section('contenido')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Cobrar</h3>
        <div class="card shadow mb-5">
            <div class="card-header py-3"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-xl-5">
                        <p class="text-primary m-0 font-weight-bold">Productos</p>
                        <div class="row">
                            <div class="col">
                                <div class="input-group"><input id="busqueda" class="bg-light form-control border-0 small" type="text" placeholder="Buscar por ...">
                                    <div class="input-group-append"><button id="btnBuscar" class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                </div>
                                <div style="margin-top: 30px;" class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre del producto</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tablaproducto">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col border-left">
                        <p class="text-primary m-0 font-weight-bold">Total</p>
                        <form id="formnota">
                            <div class="form-row">
                                <div class="col-xl-2">
                                    <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Producto:</h1>
                                    <input hidden id="idp" disabled class="form-control" type="text">
                                </div>
                                <div class="col-xl-10"><input id="producto" disabled class="form-control" type="text"></div>
                            </div>
                            <div style="margin-top: 20px;" class="form-row">
                                <div class="col">
                                    <div class="form-row">
                                        <div class="col-xl-4">
                                            <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Precio:</h1>
                                            <input id="idp" hidden class="form-control" type="text">
                                        </div>
                                        <div class="col"><input id="precio" disabled class="form-control" type="number" style="width: 100%;"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-row">
                                        <div class="col-xl-4">
                                            <h1 class="text-right" style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Cantidad:</h1>
                                        </div>
                                        <div class="col"><input disabled required id="cantidad" class="form-control" min="1" type="number" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-right" style="margin-top: 10px;"><button disabled id="btnenvio" class="btn btn-primary" type="submit">Agregar Producto</button></div>
                            </div>
                        </form>
                        <form>
                            <div class="form-row">
                                <div class="col">
                                    <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Cuenta:</h1>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th hidden>id</th>
                                                <th>Producto</th>
                                                <th>Descripción</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbnota">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-right" style="margin-top: 10px;">
                                    <h1>Total: $<input style="width: 10%" disabled id="totalpagar"></h1>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-right" style="margin-top: 10px;"><button class="btn btn-danger" type="button" style="margin-left: 0px;margin-right: 5px;">Cancelar</button><button class="btn btn-primary" type="button">Pagar Total</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="ruta-buscar" value="{{route('buscar')}}">
    <input type="hidden" id="ruta-cobrar" value="{{route('cobrar')}}">
    @include('layouts.modal-pago')
@endsection
@section('js')
    <script src="/js/pdv.js"></script>
    <script src="/js/tablaspdv.js"></script>
@endsection