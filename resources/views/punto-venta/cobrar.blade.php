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
                                <div id="prefetch" class="input-group"><input data-provide="typeahead" id="busqueda" class="typeahead bg-light form-control border-0 small " type="text" placeholder="Buscar por ...">
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
                                    <input hidden id="stock" disabled class="form-control" type="text">
                                </div>
                                <div  class="col-xl-10"><input id="producto" disabled class="form-control" type="text"></div>
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
                                        <table id="tbcuenta" class="table">
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
                                    <h1>Total: $<input style="width: 30%; font-size: 25px" disabled id="totalpagar"></h1>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-right" style="margin-top: 10px;"><a href="/cobrar" class="btn btn-danger" type="button" style="margin-left: 0px;margin-right: 5px;">Cancelar</a><button id="btnpagar" class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Pagar Total</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-open">
            <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal" aria-labelledby="exampleModalLabel" style="height: 825px;">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center justify-content-center">
                            <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;">Cobrar al cliente</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <form>
                            <div class="modal-body justify-content-center">
                                <div class="form-row">
                                    <div class="col-xl-3 offset-xl-2">
                                        <h1 style="font-size: 20px;">Su total es: $</h1>
                                    </div>
                                    <div class="col-xl-6"><input disabled id="inputtotal" type="number" class="form-control" /></div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-3 offset-xl-2">
                                        <h1 style="font-size: 20px;">Usted pago: $</h1>
                                    </div>
                                    <div class="col-xl-6"><input id="inputpago" class="form-control" type="number" /></div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button id="btnpago" class="btn btn-primary" data-dismiss="modal" type="submit">Aceptar</button></div>
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
    <script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.jquery.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                method: "get",
                url:"/obtenerproductos",
                success:function (response)
                {


                    var productNames = new Array();
                    var productIds = new Object();
//$.getJSON( '/getAjaxProducts', null,
                    // function ( jsonData )
                    //{
                    $.each( response, function ( index, product )
                    {
                        productNames.push( product.nombre );
                        productIds[product.nombre] = product.id;
                    } );

                    $( '#busqueda' ).typeahead( { source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
                        , minLength: 1 } );
                    // };
                }
            })
        })
    </script>
@endsection