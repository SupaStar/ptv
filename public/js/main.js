$(document).ready(function () {
    // Se muestran las notificaciones que haya
    $('.alert.notificacion').fadeIn();
});
var imprimirTicketReparacion = function (d) {
    var r = d.data;
    $.ajax({
        type: "POST",
        url: "http://localhost/tickets/example/ticket_reparacion.php",
        contentType: "application/json",
        data: JSON.stringify({
            "cliente": r.cliente,
            "folio": r.folio,
            "marca": r.marca,
            "modelo": r.modelo,
            "fecha_entrega": r.fecha_entrega,
            "costo": r.costo == -1 ? "Pendiente" : ("$" + parseInt(r.costo).toFixed(2)),
            "abono": r.abono == -1 ? "Ninguno" : ("$" + parseInt(r.abono).toFixed(2))
        }),
        success: function (res) {
            location.href = "/reparaciones";
        },
        error: function () {
            alerta("No se pudo imprimir el ticket.", "info");
            setTimeout(function () {
                location.href = "/reparaciones";
            }, 500);
        }
    });
}
var imprimirTicketVenta = function (productos, total, success, err) {
    var pr = [];
    for (var t = 0; t < productos.length; t++) {
        pr.push({
            "nombre": productos[t].nombre,
            "importe": "$" + (productos[t].venta * productos[t].cantidad).toFixed(2),
            "cantidad": productos[t].cantidad
        });
    }
    $.ajax({
        type: "POST",
        url: "http://localhost/tickets/example/ticket.php",
        contentType: "application/json",
        data: JSON.stringify({
            "articulos": pr,
            "total": "$" + total.toFixed(2)
        }),
        success: function () {
            success();
        },
        error: function () {
            err();
        }
    });
}
var alerta = function (mensaje, tipo = "info") {
    $(".js-generated").fadeOut(function () {
        $(this).remove();
    });
    var alert = '<div class="js-generated notificacion alert alert-' + tipo + ' alert-dismissible" role="alert">' +
        '<span class="mensaje">' + mensaje + '</span>' +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
        '<span aria-hidden="true">&times;</span>' +
        '</button>' +
        '</div>';
    $("body").append(alert);
    $(".js-generated").fadeIn();
}
// Cuando se le da al botón de abrir / cerrar caja
$(document).on("click", ".btnCambiarEstadoCaja", function (e) {
    e.preventDefault();
    var href = $(this).attr("href");
    $.ajax({
        type: "GET",
        url: href,
        success: function (data) {
            var modal = $("#modal-general");
            modal.find(".modal-content").html(data);
            modal.modal("show");
            setTimeout(function () {
                modal.find("input[name='inicial']").focus().val("");
            }, 500);
            modal.find("input[name='inicial']").off("keydown").on("keydown", function (ev) {
                if (ev.which == 13)
                    $("#btnAbrirCaja").trigger("click");
            });
            modal.find("#btnAbrirCaja").off("click").on("click", function (e) {
                $.ajax({
                    type: "POST",
                    url: $("#urlCambiarEstadoCaja").val(),
                    data: {
                        inicial: $("[name='inicial']", modal).val(),
                        observaciones: $("[name='observaciones']", modal).val()
                    },
                    success: function (r) {
                        if (r.estado) {
                            location.reload();
                        } else {
                            var f = "<ul>";
                            for (var i = 0; i < r.errores.length; i++) {
                                f += "<li>" + r.errores[i] + "</li>"
                            }
                            f += "</ul>";
                            alerta(f, "danger");
                        }
                    }
                });
            });
        }
    });
});
