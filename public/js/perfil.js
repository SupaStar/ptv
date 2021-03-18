$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/getPerfil",
        success: function (response)
        {
            $('#nombrep').val(response.name)
            $('#apellido').val(response.lastname)
            $('#nombreUsuario').val(response.username)
            $('#tipoEmpleado').val(response.admin)
            $('#tipoEmpleado').attr("disabled")

            $('#correo').val(response.email)
        }
    })
})