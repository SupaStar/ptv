$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/getCorte",
        success:function (response)
        {

            if(response.length==1)
            {

                if(response[0].fecha_hora_cierre!=null)
                {
                    $('#btnCerrarCajas').attr("hidden",true)
                    $('#btncobrar').attr("hidden",true)
                  alertify.error("Caja cerrada, regrese el dia de mañana o contacte con el administrador para abrirla")
                $('#divreabrir').removeAttr('hidden')
                }
            }
            else{
                $('#exampleModal').modal({backdrop: 'static', keyboard: false});
                $('#exampleModal').modal('toggle')
                $('#divreabrir').attr('hidden',true)
                var today = new Date();

                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                $('#inputabrircaja').attr("value",today)
            }

            $('#cajainicio').text("$"+response[0].monto_inicio)
            $('#idcaja').text("$"+response[0].monto_inicio)
            $.ajax(
                {

                    method: "get",
                    url:"/getVentashoy",
                    success:function (response)
                    {
                        var total=0;
                        for(let i=0;i<response.length;i++){
                            total=total+parseFloat(response[i].total);
                        }
                        $('#ventahoytotal').text("$"+total)
                    }

                }
            )
            $.ajax(
                {

                    method: "get",
                    url:"/getVentassemana",
                    success:function (response)
                    {
                        var total=0;
                        for(let i=0;i<response.length;i++){
                            total=total+parseFloat(response[i].total);
                        }
                        $('#ventasemana').text("$"+total)
                    }

                }
            )
            $.ajax(
                {

                    method: "get",
                    url:"/obtenerproductos",
                    success:function (response)
                    {


                        $('#nproductos').text(response.length)
                    }

                }
            )
        }
    })
})
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
$('#btnaceptarcaja').on("click", function(e){

    $.ajax(
        {
            method:"post",
            url:"/cambiar-estado-cajas",
            data:
                {
                    "inicial":$('#cajainicial').val(),
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success:function (response)
            {
            }
        }
    )
    location.href="/"

});

$('#eliminacorte').on("click", function(e){
    e.preventDefault()

    $.ajax(
        {
            method:"post",
            url:"/eliminacaja",
            data:
                {
                    "id":$('#idcaja').val(),
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success:function (response)
            {
                console.log(response)
                $('#btnCerrarCajas').attr("hidden",true)
                $('#btncobrar').attr("hidden",true)
                $('#divreabrir').removeAttr('hidden')
            }
        }
    )
    location.href="/"
});