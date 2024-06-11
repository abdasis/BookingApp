<div class="modal modal-blur fade" id="modal-room" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-azure-lt">
          <h5 class="modal-title">Tambah Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="form-fasilitas">
            @csrf
            <div class="mb-3">
              <label class="form-label">Jenis Room / Type</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Jenis Room" required>
            </div>
            <div class="modal-footer">
            </form>
              <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary btn-block btn-save" id="btn-save">Simpan</button>
            </div>

        </div>
      </div>
    </div>
  </div>
