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
        $('#tablausuarios').DataTable(
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
                    {data: "name"},
                    {data: "lastname"},
                    {data: "username"},
                    {data: "empleado"},
                    {data: "email"},
                    {data: "estado"},

                    {
                        "render": function (data, type, row, meta) {
                            if ($('#idadmin').val() == 1) {
                                let id = row.id;
                                return '<a id="btneditarusuario" style="margin-right: 3px" href="/editarusuario/' + id + '" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminausuario" onClick="obtenertb(' + id + ')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button>';
                            }
                        }

                    }
                ]

            }
        );


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
