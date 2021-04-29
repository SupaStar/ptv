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
                    'data-target="#modal-detalles-compra" onclick="detallesVentas(\''+ response[i].id +'\')" type="button"> ' + 'Mostrar <i class="fa fa-plus"></i></a>';

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
    function  detallesVentas (id){
        $.ajax({
            method:"get",
            url:"/detallesVenta/"+id,
            dataType:'json',
            success:function (response) {
                var venta = response.venta;
                $.each(response.venta.productos, function( index, value ) {
                    alert(venta.usuario.name);
                });
            }
        })

    };