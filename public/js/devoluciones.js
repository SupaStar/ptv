$(document).ready(function ()
{

    $.ajax({
        method: "get",
        dataType:'json',
        url:"/obtenerventas",
        success:function (response)
        {
            var nVentas = response.length;
            for (var x = 0; x < nVentas; x++){
                $("#pizarra").append('<tr><td>' + response[x].id + '</td><td>' + response[x].usuario + '</td><td>' + response[x].created_at + '</td><td>' + response[x].total + '</td><td>' + response[x].tipo_venta + '</td><td><a id="btneVentaid"  style="margin-right: 3px"  class="btn btn-warning" onclick="buscarventa(\''+ response[x].id +'\')" type="button"><i class="fa fa-edit"></i></a></td></tr>')
            }
        }
    })
})
function buscarventa(id){

    $.ajax({
        method:"get",
        url:"/detallesVenta/"+id,
        dataType:'json',
        success:function (response) {
            $('#tbnota').empty();
            var nVentas = response.length;
            var total1 = 0;
                $.each(response.venta.productos, function( index, value ) {
                    console.log(response);
                    var total = value.pivot.cantidad * value.venta;

                    if (total % 1 == 0) {
                        total = total+".00";
                    }
                    var subtotal = cantidad * precio;
                    var tr = `<tr>
                                  <td>`+value.nombre+`</td>
                                  <td>`+value.descripcion+`</td>
                                  <td>`+value.venta+`</td>
                                  <td>`+value.pivot.cantidad+`</td>
                                  <td class="subtotal">`+total+`</td>
                                  <td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota" class="btn btn-danger" type="button"><i class="fa fa-remove" ></i></a></td></tr>`;
                    $("#tbnota").append(tr)

                    var data = [];
                    $("td.subtotal").each(function () {
                        data.push(parseFloat($(this).text()));
                    });
                    var suma = data.reduce(function (a, b) {
                        return a + b;
                    }, 0);
                    $('#totalpagar').val(suma)

                });



        }
    })

}

