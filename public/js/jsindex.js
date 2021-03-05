$(document).ready(function ()
{
    $('#exampleModal').modal({backdrop: 'static', keyboard: false});
    $('#exampleModal').modal('toggle')
    var today = new Date();

    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#inputabrircaja').attr("value",today)

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
                    "inicial":$('#cajainicial').val()
                },
            success:function (response)
            {
                console.log(response)
            }
        }
    )

});