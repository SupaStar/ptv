$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/obtenerproductos",
        success:function (response)
        {
         for(var i=0;i<response.length;i++) {
             $('#tbproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].stock + '</td><td>' + response[i].fecha_caducidad + '</td><td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></a></td></tr>');
         }
        }
    })
})
