@extends('layouts.layout')
@section('titulo', "Registro")
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
                                            <p class="text-primary m-0 font-weight-bold">Registro de categorias</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="nombre"><strong>Nombre</strong></label>
                                                            <input class="form-control" type="number" id="nombre" name="nombre" placeholder="Nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="estado"><strong>Estado</strong></label>
                                                            <input class="form-control" type="number" id="estado" name="estado" placeholder="Estado">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm" type="submit">Registrar</button>
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
@endsection
@section('js')