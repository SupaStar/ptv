$(document).ready(function ()
{
    $('#desactivausuario').on("click", function ()
    {
        $.ajax({
            method: "post",
            url:"/desactivarusuario",
            data:{
                "id":$('#idus').val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success:function (response)
            {
                $('#tbusuarios').empty();
                $.ajax({
                    method: "get",
                    url:"/getusuarios",
                    success:function (response)
                    {
                        for(var i=0;i<response.length;i++) {
                            $('#tbusuarios').append('<tr><td>' + response[i].name + '</td><td>' + response[i].lastname + '</td><td>' + response[i].username + '</td><td>' + response[i].empleado + '</td><td>' + response[i].email + '</td><td>' + response[i].estado + '</td><td><a id="btneditarusuario" style="margin-right: 3px" href="/editarusuario/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminausuario" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                        }
                    }
                })

            }
        })
    })
$.ajax({
    method:"get",
    url:"/getusuarios",
    success:function (response) {
        for (let i = 0; i < response.length; i++) {

            $('#tbusuarios').append('<tr><td>' + response[i].name + '</td><td>' + response[i].lastname + '</td><td>' + response[i].username + '</td><td>' + response[i].empleado + '</td><td>' + response[i].email + '</td><td>' + response[i].estado + '</td><td><a id="btneditarusuario" style="margin-right: 3px" href="/editarusuario/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminausuario" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');

        }
    }
})
})
function obtenertb(id)
{
    $.ajax(
        {
            type: "post",
            url: '/findusuarioid',
            data:
                {
                    "id":id,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response)
            {
                $('#exampleModal2').modal("show");
                $('#usuarionombremodal').text("¿Desea desactivar al usuario "+response.name+" ?");
                $('#idus').val(response.id);

            }

        }
    )
}