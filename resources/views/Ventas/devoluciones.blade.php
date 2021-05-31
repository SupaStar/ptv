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
                    <form method="post" action="{{""}}">
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
                                <div class="col border-left">
                                    <p class="text-primary m-0 font-weight-bold">Total</p>
                                    <form id="formnota">
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Producto:</h1>
                                                <input id="referenciaNumVenta" hidden class="form-control" type="text">
                                            </div>
                                            <div  class="col-xl-10"><input id="producto" disabled class="form-control" type="text"></div>
                                        </div>
                                        <div style="margin-top: 20px;" class="form-row">
                                            <div class="col">
                                                <div class="form-row">
                                                    <div class="col-xl-4">
                                                        <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Precio:</h1>
                                                        <input id="idp" hidden class="form-control" type="text">
                                                        <input id="descripcion" hidden class="form-control" type="text">

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

                                                    <div class="col float-left"><button disabled id="btnenvio2" class="btn btn-primary" type="submit">Agregar Producto</button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form>
                                        <div class="form-row">
                                            <div class="col">
                                                <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Cuenta:</h1>
                                                <div class="table-responsive-sm">
                                                    <table id="tbcuenta" class="display nowrap tbejemplo" cellspacing="0" width="100%">
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
                                            <div class="col text-right" style="margin-top: 10px;"><a  id="btncancelar" class="btn btn-danger" type="button" style="margin-left: 0px;margin-right: 5px;">Cancelar</a><button   onclick="datosComparar()" class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-devolucion">continuar</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>

                </div>


            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>


        <div class="modal fade" id="modal-devolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Devolucion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('devolver.productos')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="totalfinal" name="totalfinal" >
                            <input type="hidden" id="totalinicial" name="totalinicial" >
                            <input type="hidden" id="cambio" name="cambio" >
                            <div class="form-row">
                                <div class="col">
                                    <h1 style="font-size: 18px;height: 23px;margin-top: 9px;width: 78.3px;">Devolucion:</h1>
                                    <div class="table-responsive-sm">
                                        <table id="tbcuenta2" class="display nowrap text-center" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th hidden>id</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Devuelto</th>
                                                <th>Total</th>
                                                <th>Motivo</th>
                                            </tr>
                                            </thead>

                                            <tbody id="tbdevolucion" class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-text">Observaciones*</label>
                                <textarea class="form-control" rows="5" required name="descripcion_devolucion">{{ old('descripcion_devolucion') }}</textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" value="confirmar" id="confirmar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endsection
        @section('js')
            <script src="{{asset('js/ventas.js')}}"></script>
            <script src="{{asset('js/devoluciones.js')}}"></script>
            <script src="{{asset('assets/js/datatables.min.js')}}"></script>
            <script src="/js/pdv.js"></script>
            <script src="/js/tablaspdv.js"></script>
            <script src="/js/typeahead.bundle.js"></script>


@endsection