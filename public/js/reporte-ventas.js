$(document).ready(function () {
    const from_date = moment().startOf('week');
    const to_date = moment().endOf('week');
    var rango = $('input[name="fechas"]');
    crearReporte(from_date.format("YYYY-MM-DD"), to_date.format("YYYY-MM-DD"));
    rango.daterangepicker({
        startDate: from_date,
        endDate: to_date,
        locale: {
            "format": "YYYY-MM-DD",
            "separator": " / ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "a",
            "customRangeLabel": "Otro",
            "weekLabel": "SEMANA",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 0
        },
        ranges: {
            'Actual': [from_date, to_date],
            '-1 semana': [moment().startOf("week").subtract(7, 'days'), moment().endOf("week").subtract(7, 'days')],
            '-2 semanas': [moment().startOf("week").subtract(14, 'days'), moment().endOf("week").subtract(14, 'days')],
            '-3 semanas': [moment().startOf("week").subtract(21, 'days'), moment().endOf("week").subtract(21, 'days')],
            '-4 semanas': [moment().startOf("week").subtract(28, 'days'), moment().endOf("week").subtract(28, 'days')],
            '-5 semanas': [moment().startOf("week").subtract(35, 'days'), moment().endOf("week").subtract(35, 'days')],
        }
    });
    rango.on("apply.daterangepicker", function (e, p) {
        var startDate = p.startDate.format("YYYY-MM-DD");
        var endDate = p.endDate.format("YYYY-MM-DD");

        crearReporte(startDate, endDate);
    });
});
$(document).on("click", ".btnReimprimir", function(e) {
    e.preventDefault();
    var id = $(this).attr("data-id");
    $.ajax({
        type: "GET",
        url: $("#urlVenta").val() + "/" + id,
        success: function(da) {
            imprimirTicketVenta(da.productos, parseFloat(da.total), function(){
                alerta("Se ha impreso el ticket", "success");
            }, function(){
                alerta("No se pudo imprimir el ticket, consulte con soporte", "danger");
            });
        }
    });
});
var crearReporte = function (startDate, endDate) {
    var reporte = $("#reporte");
    reporte.find(".cuerpo").html("");
    var ventasTotales = $("#ventasTotales");
    var total = $("#total");
    var utilidad = $("#utilidad");
    ventasTotales.val(0);
    total.val(0);
    utilidad.val(0);
    $.ajax({
        type: "POST",
        url: $("#urlReportar").val(),
        data: {
            startDate: startDate,
            endDate: endDate
        },
        success: function (registros) {
            var cuerpo = reporte.find(".cuerpo");
            ventasTotales.val(registros.length);
            var total_ = 0;
            var utilidad_ = 0;
            for (var f = 0; f < registros.length; f++) {
                var venta = registros[f];
                var fila = $("<tr></tr>");
                fila.append("<td>" + venta.id + "</td>");
                var productosList = "";
                for (var g = 0; g < venta.productos.length; g++) {
                    var producto = venta.productos[g];
                    productosList += "<li>" + producto.pivot.cantidad + " " + producto.nombre + "</li>";
                }
                fila.append("<td><ul>" + productosList + "</ul></td>");
                fila.append("<td>$" + venta.total + "</td>");
                fila.append("<td>$" + venta.denominacion + "</td>");
                fila.append("<td>$" + venta.cambio + "</td>");
                fila.append("<td>$" + venta.utilidad + "</td>");
                fila.append("<td>" + venta.created_at + "</td>");
                fila.append("<td><a class='btn btn-warning btnReimprimir' data-id='" + venta.id+ "'><i class='fa fa-print'></i></a></td>");
                cuerpo.append(fila);

                total_ += parseFloat(venta.total);
                utilidad_ += parseFloat(venta.utilidad);
            }
            total.val("$" + total_.toFixed(2));
            utilidad.val("$" + utilidad_.toFixed(2));
        }
    });
}