$(document).ready(function ()
{
    $('#btnCerrarCaja').on("click", function(e){
        e.preventDefault();
        var href = $(this).attr("href");
        bootbox.confirm({
            message: "¿Seguro que desea cerrar la caja?",
            locale: "es",
            callback: function(result){
                if(result)
                    location.href = href;
            }
        });
    });
    $.ajax({
        method: "get",
        url:"/obtenerventasApertura",
        success:function (response)
        {
            var total=0;
            var totalTarjeta=0;

            for(var i=0;i<response.length;i++) {
                if(response[i].tipo_venta == "Efectivo"){
                    total=total+parseFloat(response[i].total);
                }else{
                    totalTarjeta=totalTarjeta+parseFloat(response[i].total);
                }
                //Boton de Modal
                var btnDetalles = '<a class="btn btn-primary btn-sm" href="#" data-toggle="modal" ' +
                    'data-target="#modal-detalles-compra" onclick="detallesVentas(\''+ response[i].id +'\', ' +
                    '\''+ response[i].usuario +'\', \''+ response[i].total +'\', \''+ response[i].tipo_venta +'\',' +
                    '\''+ response[i].created_at + '\')" type="button"> ' + 'Mostrar <i class="fa fa-plus"></i></a>';

                $('#tbventasdia').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuario + '</td><td>'
                    + response[i].total + '</td><td>' + response[i].tipo_venta + '</td><td>' + response[i].created_at
                    + '</td><td>' + btnDetalles  + '</td></tr>');
            }
            $('#saldocorteEfectivo').val("$"+parseFloat(total))
            var porcentajeVentaTotal = ((totalTarjeta * 3.5) / 100);
            totalTarjeta  = Math.round(totalTarjeta - ((porcentajeVentaTotal * 16) / 100) - porcentajeVentaTotal);
            $('#saldocorteTarjeta').val("$"+parseFloat(totalTarjeta))
            $('#texto-total').html('Total: $'+parseFloat(total+totalTarjeta));
        }
    })
})

//Funcion para mandar los datos de venta al modal de "Detalles de Venta"
    detallesVentas = function (id, usuario, total, tipo_venta, created_at){
        document.querySelector('#DVnumVenta').innerText = 'Numero de Venta: '+(id);
        document.querySelector('#DVempleado').innerText = 'Emplead@: '+(usuario);
        document.querySelector('#DVtotalVenta').innerText = 'Total de Venta: $'+(total);
        document.querySelector('#DVtipoPago').innerText = 'Tipo de Pago: '+(tipo_venta);
        document.querySelector('#DVhoraCompra').innerText = 'Hora de Compra: '+(created_at);
        $.ajax({
            method:"get",
            url:"/detallesVenta/"+id,
            success:function (response) {
                $("#tbProductosDetallados").dataTable().fnDestroy();
                $('#tbProductosDetallados').DataTable(
                    {
                        data: response,
                        columns: [
                            {data: "nombre"},
                        ]
                    }
                );
            }
        })
    };