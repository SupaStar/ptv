$(document).ready(function ()
{
$.ajax({
    method:"get",
    url:"/getusuarios",
    success:function (response) {
        for (let i = 0; i < response.length; i++) {

            $('#tbusuarios').append('<tr><td>' + response[i].name + '</td><td>' + response[i].lastname + '</td><td>' + response[i].username + '</td><td>' + response[i].empleado + '</td><td>' + response[i].email + '</td><td><a id="btneditarstock" style="margin-right: 3px" href="/editarusuario/'+response[i].id+'" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');

        }
    }
})
})