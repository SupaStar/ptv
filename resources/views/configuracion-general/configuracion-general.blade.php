@extends('layouts.layout')
@section('titulo', "Configuracion")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/sweetalert/sweetalert.min.css')}}">
    <style>
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    }

    .switch input {
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
    </style>
@endsection
@section('contenido')
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Configuración general</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de las configuraciones generales </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-nowrap text-right">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#agregarCorreo" type="button">Agregar un nuevo correo</a>
                                @foreach ($errors->get('errorRegistro') as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                            <table id="datatable-configuracionesGenerales" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Correo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="tbproducto">
                                @foreach($configuraciones as $dato)
                                    <tr>
                                        <th idCorreo="{{$dato->id}}">{{$dato -> id}}</th>
                                        <th>{{$dato -> correo}}</th>
                                        <th>
                                            <label class="switch">
                                                <input type="checkbox" id="estadoTabla" @if($dato->estado == 1) checked @endif checkEstado="{{$dato -> id}}" class="estado">
                                                <span class="slider round"></span>
                                            </label>
                                        </th>
                                        <th>
                                            <a style="margin-right: 3px"  class="btn btn-warning editarInfo" type="button" editarid="{{$dato->id}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button id="btneliminarconf" class="btn btn-danger eliminarInfo" type="button" eliminarId="{{$dato->id}}">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Agregar correo -->
    <div class="modal fade" id="agregarCorreo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('nuevoCorreo')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-text">Correo</label>
                            <input type="email" class="form-control" name="correo"  value="{{ old('correo')}}">
                            @foreach ($errors->get('correo') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="activo">Estado</label><br>
                            <select class="form-control" required name="estado" id="estado">
                                <option value="" selected disabled>Selecciona una...</option>
                                <option @if(old('estado') == '1') selected @endif value="1">Activa</option>
                                <option @if(old('estado') == '0') selected @endif value="0">Inactiva</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <input type="submit" value="Agregar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Editar configuracion -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('editarCorreo')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="correoId" name="correoId" value="{{old('correoId')}}">
                        <div class="form-group">
                            <label class="form-text">Correo</label>
                            <input type="email" class="form-control" id="correoEditar" name="correoEditar" required value="{{ old('correoEditar')}}">
                            @foreach ($errors->get('correoEditar') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="form-text">Estado*</label>
                            <select class="form-control" required name="estadoEditar" id="estadoEditar">
                                <option value="" selected disabled>Selecciona una...</option>
                                <option @if(old('estadoEditar') == "1") selected @endif value="1">Activa</option>
                                <option @if(old('estadoEditar') == "0") selected @endif value="0">Inactiva</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Guardar nota" class="btn btn-primary">
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
        @if($errors->all())
            @if(!$errors->has('errorRegistro'))
                $("#agregarCorreo").modal("show");
            @endif
        @endif
        $(document).ready(function() {
            @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Información guardada',
                showConfirmButton: false,
                timer: 1500
            })
            @endif
            $('#datatable-configuracionesGenerales').DataTable(
                {
                    "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todo"]],
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

            $('.editarInfo').click(function (){
                var id = $(this).attr('editarId');
                buscarInfo(id);
            });

            $('.estado').change(function (){
                var id = $(this).attr('checkEstado');
                //var estado = $(this).prop('checked')== true? 1:0;
                console.log(id);
                Swal.fire({
                    title: '¿Estás seguro de editar el estado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, editar!',
                    cancelButtonText: '¡Cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        editarEstado(id);
                    }
                })
            });

            function editarEstado (id){
                $.ajax(
                    {
                        type: "get",
                        url: '/estado/'+id,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if(response.estatus == "ok"){
                                Swal.fire(
                                    'Estado editado!',
                                    'Los el estado se edito correctamente.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                })
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


            $('.eliminarInfo').click(function (){
                var id = $(this).attr('eliminarId');
                Swal.fire({
                    title: '¿Estás seguro de eliminar el correo?',
                    text: "¡No se puede recuperar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, borrar esto!',
                    cancelButtonText: '¡Cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        eliminarInformacion(id);
                    }
                })
            });

            function buscarInfo (id){
                $.ajax(
                    {
                        type: "get",
                        url: '/informacion/'+id,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if(response.estatus == "ok"){
                                var informacion = response.informacion;
                                $('#correoId').val(informacion.id)
                                $('#correoEditar').val(informacion.correo);
                                $("#estadoEditar option[value="+ informacion.estado +"]").attr("selected",true);
                                $('#modalEditar').modal("show");
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
            function eliminarInformacion (id){
                $.ajax(
                    {
                        type: "get",
                        url: '/eliminar/'+id,
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if(response.estatus == "ok"){
                                Swal.fire(
                                    'Correo eliminada!',
                                    'Los datos se eliminaron correctamente.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                })
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