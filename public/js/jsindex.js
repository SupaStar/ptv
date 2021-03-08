$(document).ready(function ()
{
$.ajax({
    method: "get",
    url:"/getCorte",
    success:function (response)
    {

       if(response.length==1)
       {
           $('#cajainicial').text(response.monto_inicio)
       }
       else{
           $('#exampleModal').modal({backdrop: 'static', keyboard: false});
           $('#exampleModal').modal('toggle')
           var today = new Date();

           var dd = String(today.getDate()).padStart(2, '0');
           var mm = String(today.getMonth() + 1).padStart(2, '0');
           var yyyy = today.getFullYear();

           today = yyyy + '-' + mm + '-' + dd;
           $('#inputabrircaja').attr("value",today)
       }
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
                    "inicial":$('#cajainicial').val()
                },
            success:function (response)
            {
                console.log(response)
            }
        }
    )

});