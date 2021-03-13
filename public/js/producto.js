$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/obtenerproductos",
        success:function (response)
        {
         for(var i=0;i<response.length;i++) {
             $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
         }
        }
    })


        $('#exampleModal').modal("show");
})
