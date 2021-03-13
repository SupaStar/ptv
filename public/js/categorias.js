$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/getcategorias",
        success:function (response)
        {
            for(var i=0;i<response.length;i++) {
                $('#tbcategorias').append('<tr><td hidden>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td><a id="btneditarcategoria" style="margin-right: 3px" href="/editarcategoria/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminacategoria"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
            }
        }
    })



})