<div class="modal-header">
    <h5 class="modal-title">Abrir caja ahora</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form class="col-8 offset-2" id="form-reparaciones" action="{{route("reparaciones.store")}}" method="POST">
    <div class="modal-body">
        <div class="container-fluid">
            {{csrf_field()}}
            <div class="row">
                <div class="col-12 form-group">
                    <label for="">Caja inicial</label>
                    <input type="text" name="inicial"
                        placeholder="Dinero inicial en caja (sólo ventas)" class="form-control onlynumbers">
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" class="form-control" rows="6"
                        placeholder="Escriba alguna observación para comenzar..."></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnAbrirCaja">Abrir caja ahora</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
</form>