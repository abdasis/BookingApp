<div>
    <a href="{{ $editUrl }}" class="btn btn-sm rounded-2 bg-warning-lt border-warning">Edit</a>
    <form action="{{ $deleteUrl }}" method="POST" style="display:inline;">
        @csrf
       @method('DELETE')
       <button class="btn btn-sm rounded-2 btn-danger" onclick="return confirm('Apakah Kamu yakin ingin menghapus voucher ini?')">Hapus</button>
    </form>
</div>
