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

                $('#tbventas').empty()
                var total = 0;
                for (var i = 0; i < response.length; i++) {
                    total = total + parseFloat(response[i].total);

                    $('#tbventas').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].usuarios.name + '</td><td>' + response[i].created_at + '</td><td>' + response[i].total + '</td></tr>');
                }
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

                                $('#tbventas').append('<tr><td>' + response[i].id + '</td><td>' + response[i].nombre + '</td><td>' + response[i].usuarios.name + '</td><td>' + response[i].created_at + '</td><td>' + response[i].total + '</td></tr>');
                            }

                        }
                    }
                )
            }
        })
    })
})
