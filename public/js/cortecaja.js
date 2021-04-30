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