$(document).ready(function ()
{

    $.ajax({
        method: "get",
        dataType:'json',
        url:"/obtenerventas",
        data: {

            "_token": $("meta[name='csrf-token']").attr("content")
        },
        success:function (response)
        {
            var nVentas = response.length;
            for (var x = 0; x < nVentas; x++){
                $("#pizarra").append('<tr><td>' + response[x].id + '</td><td>' + response[x].usuario + '</td><td>' + response[x].created_at + '</td><td>' + response[x].total + '</td><td>' + response[x].tipo_venta + '</td><td><a id="btneVentaid"  style="margin-right: 3px" class="btn btn-warning" onclick="buscarventa(\''+ response[x].id +'\')" type="button"  ><i class="fa fa-edit"></i></a></td></tr>')
            }
        }
    })
})
function buscarventa(id) {
    $.ajax({
        method: "get",
        url: "/detallesVenta/" + id,
        dataType: 'json',
        data: {

            "_token": $("meta[name='csrf-token']").attr("content")
        },
        success: function (response) {
            $('#tbnota').empty();
            $('#referenciaNumVenta').val(id);
            var nVentas = response.length;
            var total1 = 0;
            $.each(response.venta.productos, function (index, value) {

                var total = value.pivot.cantidad * value.venta;

                if (total % 1 == 0) {
                    total = total + ".00";
                }
                var subtotal = cantidad * precio;
                var tr = `<tr>
                                  <td hidden>` + value.id + `</td>
                                  <td>` + value.nombre + `</td>
                                  <td>` + value.descripcion + `</td>
                                  <td>` + value.venta + `</td>
                                  <td>` + value.pivot.cantidad + `</td>
                                  <td class="subtotal">` + total + `</td>
                                  <td><a id="btneditanota2" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota" class="btn btn-danger" type="button"><i class="fa fa-remove" ></i></a></td></tr>`;
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

    $(document).on('click', '#btncancelar', function() {
        $('#tbnota').empty();
        document.getElementById("totalpagar").value = "";
        document.getElementById("producto").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("cantidad").value = "";
    });
    $(document).on('click', '#btneditanota2', function(){
        // Your Code

        var valores = [];

        $(this).closest('tr').find("td").each(function() {

            valores.push($(this).html());

        });

        $('#idp').val(valores[0]);
        $('#producto').val(valores[1]);
        $('#descripcion').val(valores[2]);
        $('#precio').val(valores[3]);
        $('#cantidad').val(valores[4]);
        $('#cantidad').removeAttr("disabled");
        $('#btnenvio2').removeAttr("disabled");

        $(this).closest('tr').remove();
        var data = [];
        $("td.subtotal").each(function(){
            data.push(parseFloat($(this).text()));
        });
        var suma = data.reduce(function(a,b){ return a+b; },0);
        $('#totalpagar').val(suma)
    });
    $("#btnenvio2").on("click",function(event){



        event.preventDefault();
        $.ajax(
            {
                type: "post",
                url: '/findid',

                data:
                    {
                        "id":$('#idp').val(),"_token": $("meta[name='csrf-token']").attr("content")
                    },
                success: function (response)
                {
                    if($('#cantidad').val()>response.stock)
                    {
                        alertify.error('La cantidad ingresada, es mayor al stock del producto');

                    }
                    else {
                        if(($('#cantidad').val()==0||$('#cantidad').val()==""))
                        {
                            alertify.error("ingrese una cantidad mayor a 0")
                        }
                        else{
                            $('#btnenvio2').prop("disabled",true)
                            $('#cantidad').prop("disabled",true)
                            var id = $('#idp').val()
                            var nombre = $('#producto').val()
                            var descripcion = $('#descripcion').val()
                            var cantidad = parseInt($('#cantidad').val())
                            var precio = parseFloat($('#precio').val())
                            var subtotal = cantidad * precio
                            if (precio % 1 == 0) {
                                precio = precio+".00";
                            }
                            if (subtotal % 1 == 0) {
                                subtotal = subtotal+".00";
                            }
                            $('#tbnota').append('<tr><td hidden>' + id + '</td><td>' +nombre + '</td><td>' + descripcion + '</td><td>' + precio + '</td><td>' + cantidad + '</td><td class="subtotal">' + subtotal + '</td><td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></a></td></tr>');
                            $('#idp').val("")
                            $('#producto').val("")
                            $('#precio').val("")
                            $('#cantidad').val(1)

                            var data = [];
                            $("td.subtotal").each(function () {
                                data.push(parseFloat($(this).text()));
                            });
                            var suma = data.reduce(function (a, b) {
                                return a + b;
                            }, 0);
                            $('#totalpagar').val(suma)
                        }}

                }

            }

        )

        // resto de tu codigo
    });
}

function datosComparar(){
    var idVenta = $('#referenciaNumVenta').val();
    var parametros=[];
    var parame=[];
    $("#tbcuenta tbody tr").each(function(i,e){

        var tr = [];
        $(this).find("td").each(function(index, element){
            if(index != 6) // ignoramos el primer indice que dice Option #
            {
                tr.push($(this).text());
            }
        });
        parametros.push(tr);
    });
    var cantidadp = parametros.length;
    var totalinicial=0;
    for (m=0; m<cantidadp; m++){
        totalinicial=totalinicial+parseInt(parametros[m][5]);

    }
    console.log(totalinicial);
    var totalfinal= $('#totalpagar').val();
    var cambio= totalinicial-totalfinal;

    $('#totalinicial').val(totalinicial);
    $('#totalfinal').val(totalfinal);
    $('#cambio').val(cambio);


    console.log(parametros);


var opciondevo = '  <select class="form-control miselect" required >\n' +
    '                                    <option  selected disabled>Selecciona una...</option>\n' +
    '                                    <option value="1">roto/abierto</option>\n' +
    '                                    <option  value="0">Error pedido</option>\n' +
    '                                </select>'
    $.ajax({
        method: "get",
        url: "/detallesVenta/" + idVenta,
        dataType: 'json',
        data: {

            "_token": $("meta[name='csrf-token']").attr("content")
        },
        success: function (response) {
            $('#tbnota').empty();
            $('#referenciaNumVenta').val(idVenta);
            var nVentas = response.length;
            $.each(response.venta.productos, function (index, value) {

                for (i = 0; i < cantidadp; i++) {
                    if (parseInt(value.id) == parseInt(parametros[i][0])){
                        var devo= parseInt(value.pivot.cantidad)-parseInt(parametros[i][4]);
                        i= cantidadp+1;

                    }
                        }
                if (devo!=0){
                    var totalp=parseInt( value.venta)*devo;
                    if (totalp % 1 == 0) {
                        totalp = totalp+".00";
                    }
                    var tr = `<tr>
              <td hidden>`+ value.id +`</td>
              <td>` + value.nombre + `</td>
              <td>` + value.venta + `</td>
              <td>` + devo + `</td>
              <td>` + totalp + `</td>
              <td>` + opciondevo + `</td>
         
       
          </tr>`;
                    $("#tbdevolucion").append(tr)

                }

            });
        }
    })
}

$(document).on('click', '#confirmar', function(event) {
    // Your Code
    event.preventDefault();
    var parametros = [];
    var motivos=[];
    let selects = $('.miselect');

    selects.each(function () {
        let select = $(this);
        motivos.push(select.val());
    });
    $("#tbcuenta2 tbody tr").each(function (i, e) {

        var tr = [];
        $(this).find("td").each(function (index, element) {
            if (index != 6) // ignoramos el primer indice que dice Option #
            {
                if (index==5){
                    tr.push(motivos[i]);

                    }else{
                    tr.push($(this).text());
                }

            }


        });

        parametros.push(tr);
    });


        $.ajax({
            method: "post",
            url: "/devolverproductos",


            data: {
                "producto": parametros,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function (response) {

            }


        })

});