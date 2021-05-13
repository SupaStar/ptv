@extends('layouts.layout')
@section('titulo', "Ventas Generales")
@section('css')

    <link rel="stylesheet" href="{{asset('assets/css/datatables.min.css')}}">
@endsection
@section('contenido')
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Ventas generales</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"></p>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3 text-nowrap">
                                <div id="filtrar" class="dataTables_length" aria-controls="dataTable">
                                    <label>Fecha de inicio: <input id="start" class="form-control" type="date"></label>
                                    <label>Fecha de Final: <input disabled id="finish" class="form-control" type="date"></label>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="tabla" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-hover table-bordered table-striped my-0" id="tbventasgenerales">
                                    <thead>
                                    <tr>
                                        <th>N° de Venta</th>
                                        <th>Empleado</th>
                                        <th>Fecha de venta</th>
                                        <th>Total</th>
                                        <th>Forma de pago </th>
                                        <th>Detalles</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($estatus == "ok")
                                        @foreach($ventas as $venta)
                                            <tr>
                                                <td>{{$venta->id}}</td>
                                                @foreach($usuarios as $usuario)
                                                    @if ($venta->usuario_id == $usuario->id)
                                                        <td>{{$usuario->name}}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{$venta -> created_at}}</td>
                                                <td>{{$venta -> total}}</td>
                                                @if($venta->tipo_venta == 0)
                                                    <td>{{$venta->tipo_venta = "Efectivo"}}</td>
                                                @endif
                                                @if($venta->tipo_venta == 1)
                                                    <td>{{$venta->tipo_venta = "Tarjeta"}}</td>
                                                @endif
                                                <td>
                                                    <button id="detallesId" class="btn btn-primary venta" type="button" idVenta="{{$venta->id}}" >
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

            <div class="modal fade" id="modal-detalles-compra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles de la Venta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-text" id="DVnumVenta"></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-text" id="DVempleado"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-text" id="DVtotalVenta"></label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-text" id="DVtipoPago"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-2 col-md-8">
                                        <label class="form-text" id="DVhoraCompra"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <table id="tbProductosDetallados" class="table table-sm table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th >Cantidad</th>
                                                <th >Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbProductosDetalladosP">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function ()
        {
            $('.venta').click(function (){
                var id = $(this).attr('idVenta');
                console.log(id);
                $('#modal-detalles-compra').modal("show");
                detallesVentas(id)
            });
        });
        function  detallesVentas (id){
            $.ajax({
                method:"get",
                url:"/detallesVenta/"+id,
                dataType:'json',
                success:function (response) {
                    var venta = response.venta;
                    document.querySelector('#DVnumVenta').innerText = 'Numero de Venta: '+venta.id;
                    document.querySelector('#DVempleado').innerText = 'Emplead@: '+venta.usuario.name;
                    document.querySelector('#DVtotalVenta').innerText = 'Total de Venta: '+venta.total;
                    var tipo = venta.tipo_venta;
                    if(tipo == 0){
                        document.querySelector('#DVtipoPago').innerText = 'Tipo de Pago: Efectivo';
                    }else if(tipo == 1){
                        document.querySelector('#DVtipoPago').innerText = 'Tipo de Pago: Pago con tarjeta';
                    }
                    document.querySelector('#DVhoraCompra').innerText = 'Hora de Compra: '+venta.created_at;
                    $("#tbProductosDetalladosP").html("");
                    $.each(response.venta.productos, function( index, value ) {
                        var total = value.pivot.cantidad * value.venta;
                        if (total % 1 == 0) {
                            total = total+".00";
                        }
                        var tr = `<tr>
                                  <td>`+value.nombre+`</td>
                                  <td>`+value.venta+`</td>
                                  <td>`+value.pivot.cantidad+`</td>
                                  <td>`+total+`</td>
                              </tr>`;
                        $("#tbProductosDetalladosP").append(tr)
                    });
                }
            })
        };
    </script>
@endsection