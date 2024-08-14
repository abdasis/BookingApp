<div class="d-flex gap-1">
    <button data-id="{{ $wahana->id }}"
        class="btn btn-confirm-wahana btn-sm rounded-2 bg-azure-lt border-azure">Konfirmasi</button>
    {{-- <form action="{{ route('wahana-booking.destroy', $wahana->id) }}" method="POST" style="display:inline;">
        @csrf
       @method('DELETE')
       <button class="btn btn-sm rounded-2 btn-danger"
               onclick="return confirm('Apakah Kamu yakin ingin menghapus wahana ini?')">Hapus</button>
    </form> --}}
</div>
