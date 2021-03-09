var productos = [];
var total = 0;
$(document).ready(function () {

    $("body").on("keydown", function (e) {
        if (e.which == 121) { // F2
            e.preventDefault();
            $(".btn-cobrar").trigger("click");
        } else if (e.which == 27) {// ESC
            $(".js-generated").fadeOut(function () {
                $(this).remove();
            });
        }
    });
    $("#busqueda").on("keydown", function (e) {
        // Si es la flecha arriba
        if (e.which == 38 || e.which == 13) {
            e.preventDefault();
            if ($(this).val() == "")
                return;
            buscarProducto($(this).val());
        }
    });
    $("#btnBuscar").on("click", function (e) {
        e.preventDefault();
        buscarProducto($("#busqueda").val());

    });


    var buscarProducto = function (b) {
        $.ajax({
            method: "post",
            url: "/buscar",
            data: {
                "busqueda": b,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            success: function (response) {
                $('#tablaproducto').empty()
                for(let i=0;i<response.length;i++){

                $('#tablaproducto').append('<tr><td>' + response[i].codigo + '</td><td>' + response[i].nombre + '</td><td>' + response[i].venta + '</td><td>' + response[i].stock + '</td><td><a id="btnadd" onclick="obtenertb('+response[i].id+')" class="btn btn-success" type="button"><i class="fa fa-plus"></i></a></td></tr>');
            }}
        });
    }
    var recargarCuenta = function () {
        $(".cuenta").html("");
        total = 0;
        for (var t = 0; t < productos.length; t++) {
            $(".cuenta").append("<div class='row item'>" +
                "<div class='col-1 text-center'><i class='material-icons producto-eliminar' data-id='" + productos[t].id + "'>close</i></div>" +
                "<div class='col-sm-5 col-11 text-center text-md-left'>" + productos[t].nombre + "</div>" +
                "<div class='col-sm-2 col-4 producto-venta' data-id='" + productos[t].id + "'>$" + productos[t].venta + "</div>" +
                "<div class='col-sm-2 col-4 producto-cantidad' data-id='" + productos[t].id + "'>" + productos[t].cantidad + "</div>" +
                "<div class='col-sm-2 col-4'>$" + (productos[t].venta * productos[t].cantidad).toFixed(2) + "</div>"
                + "<div>");
            total += parseFloat(productos[t].venta * productos[t].cantidad);
        }
        $(".cuenta").append("<div class='total-cuenta container-fluid'>" +
            "<div class='row'>" +
            "<div class='col-8'><b>Total</b></div>" +
            "<div class='col-4'><b>$" + total.toFixed(2) + "</b></div>" +
            "</div>" +
            "<div>");
        $(document).off("dblclick").on("dblclick",".producto-cantidad", function (e) {
            e.preventDefault();
            var cantidad = $(this).text();
            var id = $(this).attr("data-id");
            $(this).text("");
            var input = "<input type='number' class='form-control cantidad-input' value='" + cantidad + "'></input>";
            $(this).html(input);
            $(document).off("keypress", ".cantidad-input").on("keypress", ".cantidad-input", function (e) {
                if (e.which == 13) {
                    var newCantidad = $(this).val();
                    if (newCantidad == 0)
                        return;
                    var index = productos.findIndex(c => c.id == id);
                    productos[index].cantidad = newCantidad;
                    recargarCuenta();
                    $("#busqueda").focus();
                }
            });
        });
        $(document).off("dblclick", ".producto-venta").on("dblclick", ".producto-venta", function (e) {
            e.preventDefault();
            var venta = $(this).text();
            venta = venta.replace("$", "");
            var id = $(this).attr("data-id");
            $(this).text("");
            var input = "<input type='number' class='form-control venta-input' value='" + venta + "'></input>";
            $(this).html(input);
            $(document).off("keypress", ".venta-input").on("keypress", ".venta-input", function (e) {
                if (e.which == 13) {
                    var newVenta = $(this).val();
                    if (newVenta == 0)
                        return;
                    var index = productos.findIndex(c => c.id == id);
                    productos[index].venta = newVenta;
                    recargarCuenta();
                    $("#busqueda").focus();
                }
            });
        });
        $(document).off("click", ".producto-eliminar").on("click", ".producto-eliminar", function () {
            var id = $(this).attr("data-id");
            var index = productos.findIndex(c => c.id == id);
            productos.splice(index, 1);
            recargarCuenta();
        });
    }
    $(".btn-cobrar").off("click").on("click", function () {
        // Si no hay productos que cobrar
        if (productos.length == 0) {
            alerta("Debe ingresar al menos 1 producto", "danger");
            return;
        }
        var modalCobro = $("#modal-cobro");
        modalCobro.find(".total").text("$" + total.toFixed(2));
        modalCobro.modal("show");
        modalCobro.find(".se-recibe").focus().val("");
        modalCobro.find(".cambio").text("$0.00");
        modalCobro.find(".se-recibe").off("keyup").on("keyup", function (e) {
            if (e.which == 13)
                $("#btn-realizar-cobro").trigger("click");
            var de = $(this).val();
            modalCobro.find(".cambio").text("$" + (de - total).toFixed(2));
        });
        $("#btn-realizar-cobro").off("click").on("click", function () {
            $("#btn-realizar-cobro").html("Espere...").attr("disabled", true);
            var denominacion = $(".se-recibe").val();
            if (denominacion < total) {
                $("#btn-realizar-cobro").html("Realizar cobro").attr("disabled", false);
                alerta("No alcanza para saldar la cuenta", "danger");
                return;
            }
            $.ajax({
                type: "POST",
                url: $("#ruta-cobrar").val(),
                data: JSON.stringify({
                    "productos": productos,
                    "denominacion": denominacion,
                    "total": total,"_token": $("meta[name='csrf-token']").attr("content"),
                    "_token": $("meta[name='csrf-token']").attr("content")
                }),
                dataType: "json",
                contentType: "application/json",
                success: function (res) {
                    $("#btn-realizar-cobro").html("Realizar cobro").attr("disabled", false);
                    if (!res.estado) {
                        alerta(res.mensaje, "danger");
                        return;
                    }
                    modalCobro.modal("hide");
                    var _t = total;
                    imprimirTicketVenta(productos, total, function () {
                        productos = [];
                        recargarCuenta();
                        alerta("Listo, <b>no olvides dar ticket al cliente</b><br>Cambio: $" + (parseFloat(denominacion) - parseFloat(_t)).toFixed(2), "success");
                        $("#busqueda").focus();
                    }, function () {
                        productos = [];
                        recargarCuenta();
                        alerta("No se pudo imprimir el ticket", "info");
                        $("#busqueda").focus();
                    });
                }
            });
        });
    });
});
