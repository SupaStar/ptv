$(document).ready(function ()
{

    $('#filtrar').on('change', function (event)
    {
        var valorselect=$('#filtrar option:selected').val();
        $.ajax({
            method: "get",
            url:"/obtenerproductos",
            data:{
                "filtro":valorselect
            },
            success:function (response)
            {
                $('#tbproducto').empty();
                if($('#idadmin').val()==0){

                    for(var i=0;i<response.length;i++) {
                        $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td></tr>');
                    }}else{

                    for(var i=0;i<response.length;i++) {
                        $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td>@if($usuario=Auth::user()->admin==1)<td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                    }}
            }
        })
    })
    $('#desactivaproducto').on("click", function ()
    {
        $.ajax({
            method: "post",
            url:"/desactivarproducto",
            data:{
                "id":$('#idprod').val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success:function (response)
            {
                $('#tbproducto').empty();
                $.ajax({
                    method: "get",
                    url:"/obtenerproductos",
                    success:function (response)
                    {
                        for(var i=0;i<response.length;i++) {
                            $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td><td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                        }
                    }
                })

            }
        })
    })
    $.ajax({
        method: "get",
        url:"/obtenerproductos",
        success:function (response)
        {
            if($('#idadmin').val()==0){

         for(var i=0;i<response.length;i++) {
             $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td></tr>');
         }}else{

         for(var i=0;i<response.length;i++) {
             $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td>@if($usuario=Auth::user()->admin==1)<td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
         }}
        }
    })
})
function obtenertb(id)
{
    $.ajax(
        {
            type: "post",
            url: '/findproductoid',
            data:
                {
                    "id":id,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response)
            {
                $('#exampleModal1').modal("show");
                $('#idprod').val(response.id);

            }

        }
    )
}

