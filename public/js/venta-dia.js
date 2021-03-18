$(document).ready(function ()
{
$.ajax({
    method: "get",
    url:"/obtenerventas",
    success:function (response)
    {
        for(var i=0;i<response.length;i++) {
            $('#tbventasdia').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuario_id+ '</td><td>' + response[i].total+ '</td></tr>');
        }
    }
})
});