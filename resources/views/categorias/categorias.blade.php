@extends('layouts.layout')
@section('titulo', "Categorias")
@section('css')

@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Categorías</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Informacion de productos y categorías</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input hidden id="idadmin" value="{{Auth::user()->admin}}">
                                @if($usuario=Auth::user()->admin==1)
                                <div class="col-md-3 text-nowrap">
                                    <a href="/registroCategoria" class="btn btn-primary btn-sm" type="submit">Agregar categoría</a>
                                </div>
                                @endif
                                <div class="col-md-3 text-nowrap">
                                    <div id="mostrar" class="dataTables_length" aria-controls="dataTable">
                                       </div>
                                </div>
                                <div class="col-md-3 text-nowrap">
                                    <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                        </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-md-right dataTables_filter" id="dataTable_filter">
                                        <label>
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Buscar">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="tbcategoria">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        @if($usuario=Auth::user()->admin==1)
                                            <th>Acciones</th>
                                        @endif

                                    </tr>
                                    </thead>
                                    <tbody id="tbcat">
                                    </tbody>
                                </table>
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