$(document).ready(function ()
{
$.ajax({
    method: "get",
    url:"/getVentassemana",
    success:function (response)
    {
        var total = 0;
        $('#tbventas').empty()
        for (var i = 0; i < response.length; i++) {
            total = total + parseFloat(response[i].total);
            $('#tbventash').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuarios.name + '</td><td>' + response[i].created_at + '</td><td>' + response[i].total + '</td></tr>');
        }
    }
})
});