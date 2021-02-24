<div class="modal-header">
    <h5 class="modal-title">Productos que coinciden {{$busqueda}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-striped tabla-productos">
        <thead>
            <tr>
                <th scope="col">Folio</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr class="producto" data-producto="{{json_encode($producto)}}">
                <th scope="row">{{$producto->id}}</th>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->venta}}</td>
                <td>{{$producto->stock}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer">
    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button> --}}
</div>
