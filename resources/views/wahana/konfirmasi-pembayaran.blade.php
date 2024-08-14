@if ($payment)
    <img src="{{ asset($payment->bukti_transfer) }}" alt="{{ $payment->bukti_transfer }}">
    <form action="{{ route('wahana-booking.store-confirm') }}" method="post">
        @csrf
        <input type="hidden" name="booking_id" value="{{ $payment->wahana_booking_id }}">
        <div class="my-3 d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-light border-light-subtle" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-teal">Konfirmasi</button>
        </div>
    </form>
@else
    <div class="alert alert-important alert-warning">
        Belum ada bukti pembayaran
    </div>
@endif
