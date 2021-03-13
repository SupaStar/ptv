$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/obtenercategoria",
        success:function (response)
        {
            for(var i=0;i<response.length;i++) {
                $('#tbcategoria').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].estado + '</td><td><a id="btneditarstock" style="margin-right: 3px" href="/editarcategoria/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
            }
        }
    })


    $('#exampleModal').modal("show");
})
