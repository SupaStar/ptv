@extends('layouts.layout')
@section('titulo', "devoluciones")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/sweetalert/sweetalert.min.css')}}">
@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3>Devolucion de la venta: </h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col border-left">
                                    <h3 class="text-primary m-0 font-weight-bold">Información de venta</h3>
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <label class="form-text">Venta ID: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="ventaId" class="form-control" type="text" value="{{$venta->id}}" readonly>
                                            </div>

                                            <div class="col-xl-2">
                                                <label class="form-text text-right">Fecha: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="precio" disabled class="form-control" type="text" value="{{$venta->created_at}}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <label class="form-text">Tipo de pago: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="referenciaNumVenta" class="form-control" type="text" value="{{$venta->tipo_venta}}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <label class="form-text">Total: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="referenciaNumVenta" class="form-control" type="text" value="{{$venta->total}}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <div class="col-xl-2">
                                                <label class="form-text">Denominación: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="precio" disabled class="form-control" type="text" style="width: 100%;" value="{{$venta->denominacion}}">
                                            </div>

                                            <div class="col-xl-2">
                                                <label class="form-text text-right">Cambio: </label>
                                            </div>
                                            <div class="col-xl-3">
                                                <input id="precio" disabled class="form-control" type="text" style="width: 100%;" value="{{$venta->cambio}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <h3 class="text-primary m-0 font-weight-bold">Productos</h3>
                                        <div class="col" style="margin-bottom: 1%; text-align: right;">
                                            <div class="col-xl-3 offset-9">
                                                <input type="text" class="form-control" id="codigo-producto-nuevo" placeholder="Ingresa el código de producto">
                                                <button class="btn btn-primary form-control" type="button"  onclick="agregarProducto()">Agregar Producto</button>
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="col-xl-3">

                                            </div>
                                        </div>
                                        <table class="table text-center table-responsive-xl">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio Venta</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           @foreach($venta->productos as $producto)
                                               <tr>
                                               <th scope="row">{{$producto->id}}</th>
                                               <th>{{$producto->nombre}}</th>
                                               <th>{{$producto->pivot->venta}}</th>
                                               <th>{{$producto->pivot->cantidad}}</th>
                                               <th>{{$producto->pivot->cantidad * $producto->pivot->venta}}</th>
                                               <th><a href="#"><i class="fa fa-2x fa-trash"></i></a></th>
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
    </div>
        @endsection
        @section('js')
            <script src="{{asset('/js/sweetalert/sweetalert.min.js')}}"></script>
            <script>
                var token = '{{csrf_token()}}';
                function agregarProducto(){
                    if($("#codigo-producto-nuevo").val() == '' || $("#codigo-producto-nuevo").val() == null){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '¡El campo código no puede estar vacio!',
                        }).then(() => {
                            $('#codigo-producto-nuevo').focus();
                        });
                        return false;
                    }

                    var form_data = new FormData();
                    form_data.append('codigo', $("#codigo-producto-nuevo").val());
                    form_data.append('ventaId', $("#ventaId").val());
                    form_data.append('_token', token);
                    $.ajax({
                        url: '/agregar-producto-devolucion',
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(respuesta){
                           // console.log(respuesta);
                            if(respuesta.estatus!= 'ok'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: respuesta.mensaje,
                                })
                            }else{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Información guardada',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        }});

                }
            </script>
@endsection