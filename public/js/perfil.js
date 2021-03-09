$(document).ready(function ()
{
    $.ajax({
        method: "get",
        url:"/getPerfil",
        success: function (response)
        {
            $('#nombrep').val(response.name)
            $('#apellido').val(response.lastname)
            $('#nombreUsuario').val(response.user)
            $('#tipoEmpleado').val(response.admin)
            $('#correo').val(response.email)
        }
    })
})