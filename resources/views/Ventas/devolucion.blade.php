@extends('layouts.layout')
@section('titulo', "Notas")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/sweetalert/sweetalert.min.css')}}">
@endsection
@section('contenido')
<div id="wrapper">
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Devoluciones del día</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de ventas del día</p>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                            <table id="datatable-notas" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>id</th>
                                    <th>Usuario</th>
                                    <th>Total</th>
                                    <th>Denominación</th>
                                    <th>Cambio</th>
                                    <th>Productos</th>
                                    <th>Tipo de pago</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="tbproducto">
                                    @foreach($ventas as $venta)
                                        <tr>
                                            <th>{{$loop->index + 1}}</th>
                                            <th>{{$venta->id}}</th>
                                            <th>{{$venta->usuario->name}}</th>
                                            <th>{{$venta->total}}</th>
                                            <th>{{$venta->denominacion}}</th>
                                            <th>{{$venta->cambio}}</th>
                                            <th>
                                                @foreach($venta->productos as $producto)
                                                    <ul>
                                                        <li>{{$producto->nombre}}</li>
                                                    </ul>
                                                @endforeach
                                            </th>
                                            <th>{{$venta->tipo_venta}}</th>
                                            <th>{{$venta->created_at}}</th>
{{--                                            <th><a style="margin-right: 3px" ventaId="{{$venta->id}}" class="btn btn-warning editar" type="button"><i class="fa fa-edit"></i></a></th>--}}
                                            <th><a style="margin-right: 3px" href="{{route("crear.devolucion",$venta->id)}}" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a></th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Modal editar-->
    <div class="modal fade" id="modal-realizar-devolucion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realizar Devolución</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_editar_venta" name="id_editar_venta" value="{{old('id_editar_venta')}}">
                        <div class="form-group">
                            <label class="form-text">Usuario: </label>
                            <input type="text" class="form-control" name="usuarioId" id="usuario-id" readonly value="{{ old('usuarioId') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-text">Total: </label>
                            <input type="text" class="form-control" name="total" id="total" readonly value="{{ old('total') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-text">Denominación: </label>
                            <input type="text" class="form-control" name="denominacion" id="denominacion" readonly value="{{ old('denominacion') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-text">Cambio: </label>
                            <input type="text" class="form-control" name="cambio" id="cambio" readonly value="{{ old('cambio') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-text">Tipo de pago: </label>
                            <input type="text" class="form-control" name="tipo" id="tipo" readonly value="{{ old('tipo') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-text">Fecha: </label>
                            <input type="text" class="form-control" name="fecha" id="fecha" readonly value="{{ old('fecha') }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Guardar venta" class="btn btn-primary">
                        </div>
                    </form>
                </div>
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
                    position: 'top-end',
                    icon: 'success',
                    title: 'Información guardada',
                    showConfirmButton: false,
                    timer: 1500
                })
                @endif
                $('#datatable-notas').DataTable(
                    {
                        "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, "All"]],
                        "searching": true,
                        destroy: true,
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay información",
                            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ Entradas",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "Sin resultados encontrados",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            }
                        }
                    }
                );

                $('.editar').click(function (){
                    var id = $(this).attr('ventaId');
                    buscarVenta(id);
                });



                function buscarVenta (id){
                    $.ajax(
                        {
                            type: "get",
                            url: '/detallesVenta/'+id,
                            dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                console.log(response);
                                if(response.estatus == "succes"){
                                    var venta = response.venta;
                                    $('#usuario-id').val(venta.usuario.name);
                                    $('#total').val(venta.total);
                                    $('#denominacion').val(venta.denominacion);
                                    $('#cambio').val(venta.cambio);
                                    $('#fecha').val(venta.created_at);
                                    $('#tipo').val(venta.tipo_venta);

                                    $('#modal-realizar-devolucion').modal("show");
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