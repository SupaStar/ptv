$(document).ready(function ()
{

    $('#btnCerrarCaja').on("click", function(e){
        e.preventDefault();
        var href = $(this).attr("href");
        bootbox.confirm({
            message: "¿Seguro que desea cerrar la caja?",
            locale: "es",
            callback: function(result){
                if(result)
                    location.href = href;
            }
        });
    });
    $.ajax({
        method: "get",
        url:"/getVentashoy",
        success:function (response)
        {
            console.log(response)
            var total=0;
            for(var i=0;i<response.length;i++) {
                total=total+parseFloat(response[i].total);

                $('#tbventasdia').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuario + '</td><td>' + response[i].total + '</td></tr>');
        }
            $('#saldocorte').val("$"+parseFloat(total))
        }

    })

})