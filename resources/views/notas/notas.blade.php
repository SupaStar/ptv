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
                <h3 class="text-dark mb-4">Mis notas</h3>
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold">Informacion de las notas</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input hidden id="idadmin" value="{{Auth::user()->admin}}">
                            <div class="col-md-12 text-nowrap text-right">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#modal-agregar-nota" type="button">Agregar nueva nota</a>
                                @foreach ($errors->get('errorRegistro') as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                            <table id="datatable-notas" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titulo</th>
                                    <th>Descripción</th>
                                    <th>Estato</th>
                                    <th>Prioridad</th>
                                    <th>Archivok</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="tbproducto">
                                    @foreach($notas as $nota)
                                        <tr>
                                            <th>{{$loop->index + 1}}</th>
                                            <th>{{$nota->titulo}}</th>
                                            <th>{{$nota->descripcion}}</th>
                                            @if($nota->estado == 1)
                                                <th>Activa</th>
                                            @else
                                                <th>Inactiva</th>
                                            @endif
                                            <th>{{$nota->prioridad}}</th>
                                            @if($nota->archivo != null)
                                            <th><a href="{{$nota->archivo}}" class="btn btn-info" target="_blank">Ver Archivo</a></th>
                                            @else
                                                <th>No contiene archivo</th>
                                            @endif
                                            <th>{{$nota->created_at}}</th>
                                            <th><a style="margin-right: 3px" notaId="{{$nota->id}}" class="btn btn-warning editar" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" class="btn btn-danger eliminar" type="button" notaId="{{$nota->id}}"><i class="fa fa-remove"></i></button></th>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-agregar-nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nueva nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('notas.agregar')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="form-text">Titulo*</label>
                            <input type="text" class="form-control" name="titulo_nota" required value="{{ old('titulo_nota') }}">
                            @foreach ($errors->get('titulo_nota') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="form-text">Texto*</label>
                            <textarea class="form-control" rows="5" required name="descripcion_nota">{{ old('descripcion_nota') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Prioridad*</label>
                            <select class="form-control" required name="prioridad_nota">
                                <option value="" selected disabled>Selecciona una...</option>
                                <option @if(old('prioridad_nota') == 'Baja') selected @endif value="Baja">Baja</option>
                                <option @if(old('prioridad_nota') == 'Media') selected @endif value="Media">Media</option>
                                <option @if(old('prioridad_nota') == 'Alta') selected @endif value="Alta">Alta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Archivo</label>
                            <input type="file" name="archivo_nota" class="form-control">
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

    <!-- Modal editar-->
    <div class="modal fade" id="modal-editar-nota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('notas.editar')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_editar_nota" name="id_editar_nota" value="{{old('id_editar_nota')}}">
                        <div class="form-group">
                            <label class="form-text">Titulo*</label>
                            <input type="text" class="form-control" id="titulo_editar_nota" name="titulo_editar_nota" required value="{{ old('titulo_editar_nota') }}">
                            @foreach ($errors->get('titulo_editar_nota') as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label class="form-text">Texto*</label>
                            <textarea class="form-control" rows="5" required id="descripcion_editar_nota" name="descripcion_editar_nota">{{ old('descripcion_editar_nota') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Estado*</label>
                            <select class="form-control" required name="estado_editar_nota" id="estado_editar_nota">
                                <option value="" selected disabled>Selecciona una...</option>
                                <option @if(old('prioridad_editar_nota') == '1') selected @endif value="1">Activa</option>
                                <option @if(old('prioridad_editar_nota') == '0') selected @endif value="0">Inactiva</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Prioridad*</label>
                            <select class="form-control" required name="prioridad_editar_nota" id="prioridad_editar_nota">
                                <option value="" selected disabled>Selecciona una...</option>
                                <option @if(old('prioridad_editar_nota') == 'Baja') selected @endif value="Baja">Baja</option>
                                <option @if(old('prioridad_editar_nota') == 'Media') selected @endif value="Media">Media</option>
                                <option @if(old('prioridad_editar_nota') == 'Alta') selected @endif value="Alta">Alta</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-text">Archivo: </label>
                            <a href="#" id="ver_archivo_editar" target="_blank" class="form-text">Ver Archivo</a>
                            <input type="file" name="archivo_editar_nota" class="form-control">
                            <h6 class="text-warning form-text">Si desea cambiar el archivo suba uno nuevo, en caso contrario omitirlo.</h6>
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
</div>
@endsection
@section('js')
    <script src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script src="{{asset('/js/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        @if($errors->all())
            @if(!$errors->has('errorRegistro'))
                $("#modal-agregar-nota").modal("show");
            @endif
        @endif
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
                        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
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
                    var id = $(this).attr('notaId');
                    buscarNota(id);
                });

                $('.eliminar').click(function (){
                    var id = $(this).attr('notaId');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás recuperar la nota!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, borrar esto!',
                        cancelButtonText: '¡Cancelar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            eliminarnota(id);
                        }
                    })
                });

                function buscarNota (id){
                    $.ajax(
                        {
                            type: "get",
                            url: '/misnotas/detalles/'+id,
                            dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if(response.estatus == "ok"){
                                    var nota = response.nota;
                                    $('#id_editar_nota').val(nota.id);
                                    $('#titulo_editar_nota').val(nota.titulo);
                                    $('#descripcion_editar_nota').val(nota.descripcion);
                                    $('#ver_archivo_editar').attr('href',nota.archivo);
                                    $("#estado_editar_nota option[value="+ nota.estado +"]").attr("selected",true);
                                    $("#prioridad_editar_nota option[value="+ nota.prioridad +"]").attr("selected",true);
                                    $('#modal-editar-nota').modal("show");
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
                function eliminarnota (id){
                    $.ajax(
                        {
                            type: "get",
                            url: '/misnotas/eliminar/'+id,
                            dataType:'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if(response.estatus == "ok"){
                                    Swal.fire(
                                        'Nota eliminada!',
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