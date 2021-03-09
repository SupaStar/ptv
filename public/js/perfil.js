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
            $('#correo').val(response.email)
        }
    })
    $('#guardaperfil').on("click",function (event)
    {
        event.preventDefault();
        $.ajax({
            method: "post",
            url:"/actualizarperfil",
            data:{
                "nombrep":$('#nombrep').val(),

                "apellido": $('#apellido').val(),
       "nombreUsuario":$('#nombreUsuario').val(),
        "tipoEmpleado":$('#tipoEmpleado').val(),
        "correo":$('#correo').val()
            },
            success:function (response)
            {
                alertify.alert('Perfil Actualizado', 'Su perfil fue actualizado con exito', function(){ alertify.success('Ok'); });

            }

        })
    })
})