$(document).ready(function () {

    $('#filtrar').on('change', function (event) {
        var valorselect = $('#filtrar option:selected').val();
        $.ajax({
            method: "get",
            url: "/obtenerproductos",
            data: {
                "filtro": valorselect
            },
            success: function (response) {
                $('#tbproducto').empty();
                if ($('#idadmin').val() == 0) {

                    for (var i = 0; i < response.length; i++) {
                        $('#tbproducto').append('<tr><td>' + response[i].id + '</td><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td></tr>');
                    }
                } else {

                    for (var i = 0; i < response.length; i++) {
                        $('#tbproducto').append('<tr><td>' + response[i].id + '</td><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td>@if($usuario=Auth::user()->admin==1)<td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/' + response[i].id + '" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onclick="obtenertb(' + response[i].id + ')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                    }
                }
            }
        })
    })
    $('#desactivaproducto').on("click", function () {
        $.ajax({
            method: "post",
            url: "/desactivarproducto",
            data: {
                "id": $('#idprod').val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function (response) {
                $('#tbproducto').empty();
                $.ajax({
                    method: "get",
                    url: "/obtenerproductos",
                    success: function (response) {
                        for (var i = 0; i < response.length; i++) {
                            $('#tbproducto').append('<tr><td>' + response[i].id + '</td><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].compra + '</td><td>' + response[i].venta + '</td><td>' + response[i].descripcion + '</td><td>' + response[i].fecha_caducidad + '</td><td>' + response[i].stock + '</td><td>' + response[i].estado + '</td><td><a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/' + response[i].id + '" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onclick="obtenertb(' + response[i].id + ')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button></td></tr>');
                        }
                    }
                })

            }
        })
    })
    $.ajax({
        method: "get",
        url: "/obtenerproductos",
        success: function (response) {
            $('#dtproductos').DataTable(
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
                        {data: "codigo"},
                        {data: "nombre"},
                        {data: "compra"},
                        {data: "venta"},
                        {data: "descripcion"},
                        {data: "fecha_caducidad"},
                        {data: "stock"},
                        {data: "estado"},
                        {
                            "render": function (data, type, row, meta) {
                                if ($('#idadmin').val() == 1) {
                                    let id = row.id;
                                    return '<a id="btneditarstock" style="margin-right: 3px" href="/editarproducto/' + id + '" class="btn btn-warning" type="button"><i class="fa fa-edit"></i></a><button id="btneliminaproducto" onClick="obtenertb(' + id + ')"  class="btn btn-danger" type="button"><i class="fa fa-remove"></i></button>';
                                }
                            }

                        }
                    ]
                });
        }
    })
})

function obtenertb(id) {
    $.ajax(
        {
            type: "post",
            url: '/findproductoid',
            data:
                {
                    "id": id,
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
            success: function (response) {
                $('#exampleModal1').modal("show");
                $('#idprod').val(response.id);

            }

        }
    )
}

