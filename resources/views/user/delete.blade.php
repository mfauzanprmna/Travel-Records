    {{-- !-- Delete Warning Modal --> --}}
    <form action="{{ route('akun.destroy', $user->id) }}" method="post">
        <div class="modal-body">
            @csrf
            @method('DELETE')
            <h5 class="text-center">Anda yakin ingin menghapus Akun ini ?</h5>
            <h5 class="text-center">Jika iya, data akun akan dihapus permanen</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" class="close">Cancel</button>
            <button type="submit" class="btn btn-danger">Yes, Delete Akun</button>
        </div>
    </form>