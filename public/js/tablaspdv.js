$("#btnenvio").on("click",function(event){
    event.preventDefault();
    $('#btnenvio').prop("disabled",true)
    $('#cantidad').prop("disabled",true)
    $.ajax(
        {
            type: "post",
            url: '/findid/',

            data:
                {
                    "id":$('#idp').val(),"_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response)
            {
                var cantidad= parseInt($('#cantidad').val())
                var precio= parseFloat($('#precio').val())
                var subtotal=cantidad*precio
                $('#tbnota').append('<tr><td hidden>' + response.id + '</td><td>' + response.nombre + '</td><td>' + response.descripcion + '</td><td>' + response.venta + '</td><td>' + cantidad + '</td><td class="subtotal">' + subtotal + '</td><td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></a></td></tr>');
                $('#idp').val("")
                $('#producto').val("")
                $('#precio').val("")
                $('#cantidad').val(1)

                var data = [];
                $("td.subtotal").each(function(){
                    data.push(parseFloat($(this).text()));
                });
                var suma = data.reduce(function(a,b){ return a+b; },0);
                $('#totalpagar').val(suma)


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
            url: '/findid/',
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
                $('#cantidad').removeAttr("disabled")
                $('#btnenvio').removeAttr("disabled")
                $('#tablaproducto').empty();


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
if($('#inputpago').val()>=$('#inputtotal').val()){

    $.ajax({
        method:"post",
        url:"/cobrarp/",

        data:{
            "producto":parametros, "total":$('#inputtotal').val(),"denominacion":$('#inputpago').val(),
            "_token": $("meta[name='csrf-token']").attr("content")
        },
        success:function (response)
        {

            $('#inputtotal').val("");
            $('#inputpago').val("");
            $('#inputpago').val("");
            $('#tbnota').empty();

        }
    })}
else{
    alert("nel")
}
});
