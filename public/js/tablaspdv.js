$("#btnenvio").on("click",function(event){



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
                    $('#btnenvio').prop("disabled",true)
                    $('#cantidad').prop("disabled",true)
                    var cantidad = parseInt($('#cantidad').val())
                    var precio = parseFloat($('#precio').val())
                    var subtotal = cantidad * precio
                    $('#tbnota').append('<tr><td hidden>' + response.id + '</td><td>' + response.nombre + '</td><td>' + response.descripcion + '</td><td>' + response.venta + '</td><td>' + cantidad + '</td><td class="subtotal">' + subtotal + '</td><td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></a></td></tr>');
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
function obtenertb(id)
{
    $.ajax(
        {
            type: "post",
            url: '/findid',
            data:
                {
                    "id":id,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response)
            {
                $('#idp').val(response.id)
                $('#producto').val(response.nombre)
                $('#precio').val(response.venta)
                $('#cantidad').attr("max",response.stock)
                $('#cantidad').attr("value",1)
                $('#stock').val(response.stock)
                $('#cantidad').removeAttr("disabled")
                $('#btnenvio').removeAttr("disabled")
                $('#stockt').val(response.stock)
            }

        }
    )


}
$(document).on('click', '#btneliminanota', function(){
    // Your Code
    $(this).closest('tr').remove();
    var data = [];
    $("td.subtotal").each(function(){
        data.push(parseFloat($(this).text()));
    });
    var suma = data.reduce(function(a,b){ return a+b; },0);
    $('#totalpagar').val(suma)
});
$(document).on('click', '#btneditanota', function(){
    // Your Code
    var valores = [];

    $(this).closest('tr').find("td").each(function() {

        valores.push($(this).html());

    });
    $('#idp').val(valores[0]);
    $('#producto').val(valores[1]);
    $('#precio').val(valores[3]);
    $('#cantidad').val(valores[4]);
    $('#cantidad').removeAttr("disabled");
    $('#btnenvio').removeAttr("disabled");
    $(this).closest('tr').remove();
    var data = [];
    $("td.subtotal").each(function(){
        data.push(parseFloat($(this).text()));
    });
    var suma = data.reduce(function(a,b){ return a+b; },0);
    $('#totalpagar').val(suma)
});
$(document).on('click', '#btnpagar', function(event){
    // Your Code
    let total=parseFloat($('#totalpagar').val());
    $('#inputtotal').val(total);
});
$(document).on('click', '#btnpago', function(event){
    // Your Code
    event.preventDefault();
    var parametros=[];
    var parame=[];
    $("#tbcuenta tbody tr").each(function(i,e){

        var tr = [];
        $(this).find("td").each(function(index, element){
            if(index != 6) // ignoramos el primer indice que dice Option #
            {
                ;
                tr.push($(this).text());
            }
        });
        parametros.push(tr);
    });
   var cambio= $('#inputpago').val()-$('#inputtotal').val()
if(cambio>=0){

    $.ajax({
        method:"post",
        url:"/cobrarp",

        data:{
            "producto":parametros, "total":$('#inputtotal').val(),"denominacion":$('#inputpago').val(),
            'tipo_venta':$("#tipo_venta").val(),
            "_token": $("meta[name='csrf-token']").attr("content")
        },
        success:function (response)
        {


            imprimirTicketVentas(parametros, $('#inputtotal').val(), function () {
                alerta("Listo, <b>no olvides dar ticket al cliente</b><br>Cambio: $" + (parseFloat(denominacion) - parseFloat(_t)).toFixed(2), "success");
                alertify.alert('Cobro realizado Correctamente', 'Su cambio es de: '+cambio, function(){ alertify.success('Pago realizado correctamente', location.reload()); });

            }, function () {

                alerta("No se pudo imprimir el ticket", "info");

            });
            $('#inputtotal').val("");
            $('#inputpago').val("");
            $('#totalpagar').val("");
            $('#tbnota').empty();
            alertify.alert('Cobro realizado Correctamente', 'Su cambio es de: '+cambio, function(){ alertify.success('Pago realizado correctamente', location.reload()); });
        }
    })}
    else{
        alertify.error("Su pago no cubre el total de la venta")
}
});
var alerta = function (mensaje, tipo = "info") {
    $(".js-generated").fadeOut(function () {
        $(this).remove();
    });
    var alert = '<div class="js-generated notificacion alert alert-' + tipo + ' alert-dismissible" role="alert">' +
        '<span class="mensaje">' + mensaje + '</span>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>';
    $("body").append(alert);
    $(".js-generated").fadeIn();
}
var imprimirTicketVentas = function (productos, total, success, err) {

    var pr = [];
    for (var t = 0; t < productos.length; t++) {
        console.log(total)
        pr.push({
            "nombre": productos[t][1],
            "importe": "$" + (productos[t][3] * productos[t][4]).toFixed(2),
            "cantidad": productos[t][4]
        });
    }
    $.ajax({
        type: "POST",
        url: "http://localhost/tickets/example/ticket.php",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
         contentType: "application/json",
       data: JSON.stringify({
            "articulos": pr,
            "total": "$" + total,
        }),
        success: function (response) {
            console.log(response)
            success();
        },
        error: function (response) {
            console.log(response)
            err();
        }
    });
}
