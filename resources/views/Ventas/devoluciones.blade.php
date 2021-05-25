@extends('layouts.layout')
@section('titulo', "devoluciones")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
@endsection
@section('contenido')

        <div class="d-flex flex-colum col-md-10">
            <div id="content">
                <div class="container-fluid ">
                    <h3>Devoluciones</h3>
                    <form method="post" action="{{""}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-bordered table-hover my-0" style="width: 100%" id="tablaventashoy">
                                    <thead>
                                    <tr>
                                        <th>N° de Venta</th>
                                        <th>Empleado</th>
                                        <th>Fecha de venta</th>
                                        <th>Total</th>
                                        <th>Forma de pago</th>
                                        <th>Accion</th>
                                    </tr>
                                    </thead>
                                    <tbody id="pizarra">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!--
                                <div class="col-md-6 col-xl-5">
                                    <p class="text-primary m-0 font-weight-bold">Productos</p>
                                    <div class="row">
                                        <div class="col">

                                            <div style="margin-top: 30px;" class="table-responsive table-sm">
                                                <table id="tbproductosb" class="table table-sm table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Nombre del producto</th>
                                                        <th>Precio</th>
                                                        <th >Stock</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tablaproducto">
                                                    @foreach($productos as $producto)
                                                        <tr><td>{{$producto->codigo}}</td>
                                                            <td>{{$producto->nombre}}</td>
                                                            <td>{{$producto->venta}}</td>
                                                            <td>{{$producto->stock}}</td>
                                                            <td><a id="btnadd" onClick="obtenertb({{$producto->id}})" class="btn btn btn-success" type="button"><i class="fa fa-plus"></i></a></td></tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
-->
                                <div class="col border-left">
                                    <p class="text-primary m-0 font-weight-bold">Total</p>
                                    <form id="formnota">
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Producto:</h1>
                                                <input  id="producto" disabled class="form-control" type="text">
                                                <input  id="stock" disabled class="form-control" type="text">

                                            </div>
                                            <div  class="col-xl-10"><input id="idp" disabled class="form-control" type="text"></div>
                                        </div>
                                        <div style="margin-top: 20px;" class="form-row">
                                            <div class="col">
                                                <div class="form-row">
                                                    <div class="col-xl-4">
                                                        <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Precio:</h1>
                                                        <input id="idp"  class="form-control" type="text">
                                                    </div>
                                                    <div class="col"><input id="precio" disabled class="form-control" type="number" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-row">
                                                    <div class="col-xl-4">
                                                        <h1 class="text-right" style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Cantidad:</h1>
                                                    </div>
                                                    <div class="col"><input disabled required id="cantidad" class="form-control" min="1" type="number" onkeypress="return isNumberKey(this);" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 20px;" class="form-row">

                                            <div class="col">
                                                <div class="form-row">

                                                    <div class="col float-left"><button disabled id="btnenvio" class="btn btn-primary" type="submit">Agregar Producto</button></div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <form>
                                        <div class="form-row">
                                            <div class="col">
                                                <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Cuenta:</h1>
                                                <div class="table-responsive-sm">
                                                    <table id="tbcuenta" class="display nowrap" cellspacing="0" width="100%">
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
                                                <h1 style="font-size: 25px">Total: $<input style="width: 30%; font-size: 25px" disabled id="totalpagar"></h1>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col text-right" style="margin-top: 10px;"><a href="/cobrar" class="btn btn-danger" type="button" style="margin-left: 0px;margin-right: 5px;">Cancelar</a><button id="btnpagar" class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">Actualizar compra</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-text">Motivo de devolucion</label>
                            <select class="form-control" required >
                                <option value="" selected disabled>Selecciona una...</option>
                                <option value="Baja">Producto roto/Abierto/caducado etc..</option>
                                <option  value="Media">Error en el pedido</option>
                                <option value="Alta">otro error</option>
                                <option value="Alta">otro... espesifique en obsevaciones</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Observaciones*</label>
                            <textarea class="form-control" rows="5" required name="descripcion_devolucion">{{ old('descripcion_devolucion') }}</textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Devolver" class="btn btn-primary">
                        </div>

                    </form>
                        </div>
                    </div>

                </div>


            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>




        @endsection
        @section('js')
            <script src="{{asset('js/ventas.js')}}"></script>
            <script src="{{asset('js/devoluciones.js')}}"></script>
            <script src="{{asset('assets/js/datatables.min.js')}}"></script>
            <script src="/js/pdv.js"></script>
            <script src="/js/tablaspdv.js"></script>
            <script src="/js/typeahead.bundle.js"></script>


@endsection