<div class="modal" tabindex="-1" role="dialog" id="modal-delete-{{$entrada->id}}">
    <form action="{{route('entrada.destroy',['entrada'=>$entrada->id])}}" method="post">
                @method('DELETE')
                @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Realmente deseas eliminar el registro {{$entrada->titulo}}?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </form>
</div>