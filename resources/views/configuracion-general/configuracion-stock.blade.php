@extends('layouts.layout')
@section('titulo', "Configuracion")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/sweetalert/sweetalert.min.css')}}">
@endsection
@section('contenido')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Configuración del stock</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de la configuracion de Stock de productos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @if($estatus == "no")
                                    <form method="post" action="{{route('agregarStock')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label class="form-text">Cantidad de productos</label>
                                                <input type="number" class="form-control" name="nProductos"  value="{{ old('nProductos')}}">
                                                @foreach ($errors->get('nProductos') as $error)
                                                    <div class="alert alert-danger">{{ $error }}</div>
                                                @endforeach
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="activo">Dias de aviso </label><br>
                                                <input type="number" class="form-control" name="diasAviso"  value="{{ old('diasAviso')}}">
                                                @foreach ($errors->get('diasAviso') as $error)
                                                    <div class="alert alert-danger">{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-12" align="right">
                                            <input type="submit" value="Agregar Configuracion" class="btn btn-primary">
                                        </div>
                                    </form>
                                @endif

                                @if($estatus == "ok")
                                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                            <table id="datatable-configuracionesGenerales" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th>Configuración</th>
                                                    <th>Valor</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tr>
                                                    <th>Stock de productos</th>
                                                    <th>{{$stockCaducidad -> stock." productos "}}</th>
                                                    <th>
                                                        <button id="detallesId" class="btn btn-warning stock" type="button" stock="{{$stockCaducidad->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Días de aviso</th>
                                                    <th>{{$stockCaducidad -> fecha_caducidad." días"}}</th>
                                                    <th>
                                                        <button id="detallesId" class="btn btn-warning caducidad" type="button" caducidad="{{$stockCaducidad->id}}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!--- modal stock--->
    <div class="modal fade" id="stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('editarStock')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="stockId" name="stockId" value="{{old('stockId')}}">
                        <div class="form-group">
                            <label class="form-text">Cantidad minima de productos por terminar</label>
                            <input type="number" class="form-control" id="productosTerminar" name="productosTerminar" required value="{{old('productosTerminar')}}">
                            @foreach ($errors->get('productosTerminar') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--- modal caducidad-->
    <div class="modal fade" id="caducidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del aviso de días</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('editarCaducidad')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="caducidadId" name="caducidadId" value="{{old('caducidadId')}}">
                        <div class="form-group">
                            <label class="form-text">Cantidad minima de dias para aviso de caducidad</label>
                            <input type="number" class="form-control" id="diasAviso" name="diasAviso" required value="{{old('diasAviso')}}">
                            @foreach ($errors->get('diasAviso') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Información guardada',
                showConfirmButton: false,
                timer: 1500
            })
            @endif

            $('.stock').click(function (){
                var id = $(this).attr('stock');
                stock(id);
            });
            $('.caducidad').click(function (){
                var id = $(this).attr('caducidad');
                caducidad(id);
            });

            function stock (id){
                $.ajax(
                    {
                        type: "get",
                        url: '/informacionStock/'+id,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if(response.estatus == "ok"){
                                var informacion = response.informacion;
                                $('#stockId').val(informacion.id)
                                $('#productosTerminar').val(informacion.stock);
                                $('#stock').modal("show");
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '¡Contacta al desarrollador!',
                                })
                            }
                        }
                    }
                )
            }

            function caducidad (id){
                $.ajax(
                    {
                        type: "get",
                        url: '/informacionStock/'+id,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if(response.estatus == "ok"){
                                var informacion = response.informacion;
                                $('#caducidadId').val(informacion.id)
                                $('#diasAviso').val(informacion.fecha_caducidad);
                                $('#caducidad').modal("show");
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: '¡Contacta al desarrollador!',
                                })
                            }
                        }
                    }
                )
            }
        } );
    </script>
@endsection