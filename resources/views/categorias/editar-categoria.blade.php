@extends('layouts.layout')
@section('titulo', "Actualizar")
@section('css')

@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Categorias</h3>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">Editar categoria: {{$categoria->nombre}}</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="/actualizarcategoria">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="nombre"><strong>Nombre</strong></label>
                                                            {{ csrf_field() }}
                                                            <input value="{{$categoria->id}}" class="form-control" type="text" id="id" name="id" hidden>
                                                            <input value="{{$categoria->nombre}}" class="form-control" type="text" id="nombre" name="nombre" placeholder="nombre">
                                                        </div>
                                                        <div class="form-group">
                                                            <i class="fa fa-user-md icono" aria-hidden="true"></i>
                                                            <label for="estado"><strong>Estado</strong></label>
                                                            <select id="estado" name="estado" class="form-control" required id="estado">
                                                                @if($categoria->estado==0)
                                                                    <option selected value="0">Desactivado</option>
                                                                    <option value="1">Activado</option>
                                                                @elseif($categoria->estado==1)
                                                                    <option  value="0">Desactivado</option>
                                                                    <option selected value="1">Activado</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm" type="submit">Actualizar</button>
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
    <div id="modal-open">
        <div role="dialog" tabindex="-1" class="modal fade show" id="exampleModal3" aria-labelledby="exampleModalLabel" style="height: 825px;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center justify-content-center">
                        <h4 class="modal-title text-center" style="color: rgb(0,0,0);width: 100%;" id="categorianombremodal"></h4><input id="idcat" type="text" style="width: 211px;" hidden /><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-footer justify-content-center"><button class="btn btn-danger float-right" data-dismiss="modal" type="button">Cancelar</button><button id="desactivacategoria" class="btn btn-primary" data-dismiss="modal" type="button">Aceptar</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('/js/categorias.js')}}"></script>
@endsection