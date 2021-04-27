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
        url:"/getVentashoy",
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
                $('#tbventasdia').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuario + '</td><td>' + response[i].total + '</td><td>' + response[i].tipo_venta + '</td><td>' + response[i].created_at + '</td></tr>');
            }
            $('#saldocorteEfectivo').val("$"+parseFloat(total))
            var porcentajeVentaTotal = ((totalTarjeta * 3.5) / 100);
            totalTarjeta  = Math.round(totalTarjeta - ((porcentajeVentaTotal * 16) / 100) - porcentajeVentaTotal);
            $('#saldocorteTarjeta').val("$"+parseFloat(totalTarjeta))
            $('#texto-total').html('Total: $'+parseFloat(total+totalTarjeta));
        }

    })

})