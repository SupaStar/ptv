$(".producto-compra,.producto-venta").on("dblclick", function () {
    var id = $(this).parent().attr("data-id");
    var tipo = $(this).attr("data-tipo");
    var precio_ = $(this).text();
    $(this).text("");
    $(this).html("<input type='number' class='form-control nuevo-precio' data-id='" + id + "' data-tipo='" + tipo + "' value='" + parseInt(precio_) + "'></input>");
    $(document).off("keydown",".nuevo-precio").on("keydown", ".nuevo-precio", function (e) {
        var input = $(this);
        if (e.which == 13) {
            var id = input.attr("data-id");
            var tipo = input.attr("data-tipo");
            var precio = input.val();
            $.ajax({
                type: "PUT",
                url: $("#ruta-editar-precio").val(),
                data: {
                    id: id,
                    tipo: tipo,
                    precio: precio
                },
                success: function (r) {
                    if (r.estado) {
                        input.parent().text(parseFloat(precio).toFixed(2));
                        input.parent().html("");
                    } else {
                        alerta("No se pudo modificar el precio", "danger");
                        input.parent().text(precio_);
                        input.parent().html("");

                    }
                }
            });
        }
        if (e.which == 27) {
            input.parent().text(precio_);
            input.parent().html("");
        }
    });
});
$(".btnEliminar").on("click", function(e){
    e.preventDefault();
    var form = $(this).find('.delete-form');
    bootbox.confirm("¿Segur@?", function(result){
        form.submit();
    });
});
$(".producto-nombre").on("dblclick", function () {
    var id = $(this).parent().attr("data-id");
    var nombre_ = $(this).text();
    $(this).text("");
    $(this).html("<input type='text' class='form-control nuevo-nombre' data-id='" + id + "' value='" + nombre_ + "'></input>");
    $(document).off("keydown",".nuevo-nombre").on("keydown", ".nuevo-nombre", function (e) {
        var input = $(this);
        if (e.which == 13) {

            var id = input.attr("data-id");
            var nombre = input.val();
            $.ajax({
                type: "PUT",
                url: $("#ruta-editar-nombre").val(),
                data: {
                    id: id,
                    nombre: nombre
                },
                success: function (r) {
                    if (r.estado) {
                        input.parent().text(nombre);
                        input.parent().html("");
                    } else {
                        alerta("No se pudo modificar el nombre", "danger");
                        input.parent().text(nombre_);
                        input.parent().html("");

                    }
                }
            });
        }
        if (e.which == 27) {
            input.parent().text(nombre_);
            input.parent().html("");
        }
    });
});
$(".producto-stock").on("dblclick", function () {
    var id = $(this).parent().attr("data-id");
    var stock_ = $(this).text();
    $(this).text("");
    $(this).html("<input type='number' class='form-control nuevo-stock' data-id='" + id + "' value='" + stock_ + "'></input>");
    $(document).off("keydown",".nuevo-stock").on("keydown", ".nuevo-stock", function (e) {
        var input = $(this);
        if (e.which == 13) {

            var id = input.attr("data-id");
            var stock = input.val();
            $.ajax({
                type: "PUT",
                url: $("#ruta-editar-stock").val(),
                data: {
                    id: id,
                    stock: stock
                },
                success: function (r) {
                    if (r.estado) {
                        input.parent().text(stock);
                        input.parent().html("");
                    } else {
                        alerta("No se pudo modificar el stock", "danger");
                        input.parent().text(stock_);
                        input.parent().html("");

                    }
                }
            });
        }
        if (e.which == 27) {
            input.parent().text(stock_);
            input.parent().html("");
        }
    });
});
$('#tabla-productos tfoot th').each(function () {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
});
var tab = $("#tabla-productos").DataTable({
    order: [[1,"asc"]],
    language: es,
    responsive: {
        details: {
            display: $.fn.dataTable.Responsive.display.childRowImmediate,
            type: 'none',
            target: ''
        }
    }
});
// Apply the search
tab.columns().every(function () {
    var that = this;

    $('input', this.footer()).on('keyup change clear', function () {
        if (that.search() !== this.value) {
            that
                .search(this.value)
                .draw();
        }
    });
});
