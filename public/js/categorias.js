$(document).ready(function ()
{
    $('#desactivacategoria').on("click", function ()
    {
        $.ajax({
            method: "post",
            url:"/desactivarcategoria",
            data:{
                "id":$('#idcat').val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success:function (response)
            {

                $.ajax({
                    method: "get",
                    url:"/getcategorias",
                    success:function (response)
                    { $('#tbcat').empty();
                        if($('#idadmin').val()==0){
                        for(var i=0;i<response.length;i++) {
                            $('#tbcat').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].estado + '</td></tr>');
                        }}
                        else{
                        for(var i=0;i<response.length;i++) {
                            $('#tbcat').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].estado + '</td><td><a id="btneditarcategoria" style="margin-right: 3px" href="/editarcategoria/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminacategoria" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                        }}
                    }
                })

            }
        })
    })
    $.ajax({
        method: "get",
        url:"/getcategorias",
        success:function (response)
        {
            $('#tbcat').empty();
            if($('#idadmin').val()==0){
                for(var i=0;i<response.length;i++) {
                    $('#tbcat').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].estado + '</td></tr>');
                }}
            else{
                for(var i=0;i<response.length;i++) {
                    $('#tbcat').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].estado + '</td><td><a id="btneditarcategoria" style="margin-right: 3px" href="/editarcategoria/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminacategoria" onclick="obtenertb('+response[i].id+')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                }}
        }
    })



})
function obtenertb(id)
{
    $.ajax(
        {
            type: "post",
            url: '/findcatid',
            data:
                {
                    "id":id,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response)
            {
                console.log(response)
                $('#exampleModal3').modal("show");
                $('#categorianombremodal').text("¿Desea desactivar la categoria  "+response.nombre+" ?");
                $('#idcat').val(response.id);

            }

        }
    )
}