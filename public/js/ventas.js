$(document).ready(function () {

    var today = new Date();

    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#start').attr('max', today);
    $('#start').attr('value', today);
    $('#finish').attr('max', today);
    $('#finish').attr('value', today);
    $(function () {
        $('#start').change(function () {
            $('#finish').removeAttr("disabled")
        })
    })
    $.ajax(
        {
            method: "get",
            url: "/ventasgenerales",
            success: function (response) {
                var total = 0;
                for (var i = 0; i < response.length; i++) {
                    total = total + parseFloat(response[i].total);
                }
                $('#tbventasgenerales').DataTable(
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
                            {data: "usuarios.name"},
                            {data: "created_at"},
                            {data: "total"},
                            {data: "cp.0.cantidad"}
                        ]

                    }
                )


            }
        }
    )
    $(function () {
        $('#finish').change(function () {
            if ($('#start').val() > $('#finish').val()) {
                alert("Seleccione una fecha de inicio menor a la final")
                $('#finish').attr('disabled')
            } else {
                $('#finish').attr('disabled')
                $.ajax(
                    {
                        method:"post",
                        url:"/ventasfecha",
                        data:
                            {
                                "inicio":$('#start').val(),
                                "final":$('#finish').val()
                            },
                        success:function (response)
                        {
                            var total = 0;
                            $('#tbventas').empty()
                            for (var i = 0; i < response.length; i++) {
                                total = total + parseFloat(response[i].total);

                                $('#tbventas').append('<tr><td>' + response[i].id + '</td><td>' + response[i].usuarios.name + '</td><td>' + response[i].created_at + '</td><td>' + response[i].total + '</td></tr>');
                            }

                        }
                    }
                )
            }
        })
    })
})

