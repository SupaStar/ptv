$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/obtenerproductos",
        success:function (response)
        {
         for(var i=0;i<response.length;i++) {
            console.log(response); $('#tbproducto').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].stock + '</td><td>'  + '</td><td><a id="btneditanota" style="margin-right: 3px" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><a id="btneliminanota"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></a></td></tr>');
         }
        }
    })
})
