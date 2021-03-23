$(document).ready(function ()
{
$.ajax({
    method: "get",
    url:"/obtenerventas",
    success:function (response)
    {
        $('#tablaventashoy').DataTable(
            {
                data: response,
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "bFilter": false,
                columns: [
                    {data: "id"},
                    {data: "usuario"},
                    {data: "created_at"},
                    {data: "total"}
                ]

            }
        );
        var total = 0;
        for (var i = 0; i < response.length; i++) {
            total = total + parseFloat(response[i].total);
          }
    }
})
});