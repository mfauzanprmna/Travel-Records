    {{-- !-- Delete Warning Modal --> --}}
    <form action="{{ route('catper.destroy', $catper->id) }}" method="post">
        <div class="modal-body">
            @csrf
            @method('DELETE')
            <h5 class="text-center">Anda yakin ingin menghapus data ini ?</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" class="close">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete Data</button>
        </div>
    </form>
