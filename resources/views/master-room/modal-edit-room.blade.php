<div class="modal modal-blur fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-azure-lt">
                <h5 class="modal-title">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label class="form-label">Nama Room</label>
                        <input type="text" class="form-control" name="nama" id="EditNama"
                            placeholder="Masukan Nama Room" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Room</label>
                        <input type="text" class="form-control" name="qty" id="EditQty"
                            placeholder="Masukan Jumlah Room" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Max Checkout</label>
                        <input type="time" class="form-control" name="checkout" id="EditCheckout"
                            placeholder="Max Checkout" required>
                    </div>
                    <div class="modal-footer">
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-update">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
</div>
