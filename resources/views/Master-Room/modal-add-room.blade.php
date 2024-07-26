<div class="modal modal-blur fade" id="modal-room" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-azure-lt">
          <h5 class="modal-title">Tambah Room</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" id="form-room">
            @csrf
             <div class="mb-3">
              <label class="form-label">Jenis Room / Kamar</label>
              <select name="roomtype" class="form-control">
                <option value="">--Pilih Salah Satu--</option>
                @foreach ($type as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
            </select>

            </div>
            <div class="mb-3">
              <label class="form-label">Nama Room</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Room" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi Room</label>
              <input type="text" class="form-control" name="deskripsi" placeholder="Masukan Desktripsi Room" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Jumlah Room</label>
              <input type="text" class="form-control" name="qty" placeholder="Masukan Jumlah Room" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Max Checkout</label>
              <input type="time" class="form-control" name="checkout" placeholder="Max Checkout" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tarif WeekDays</label>
              <input type="number" class="form-control" name="tarifWd" placeholder="Tarif Senin - Jumat" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tarif WeekEnd</label>
              <input type="number" class="form-control" name="tarifWe" placeholder="Tarif Sabtu - Minggu" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Fasilitas</label>
                <div class="form-selectgroup">
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="AC" class="form-selectgroup-input" checked="">
                                <span class="form-selectgroup-label">AC</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="TV" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">TV</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Kulkas" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Kulkas</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Air Panas" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Air Panas</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Air Dingin" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Air Dingin</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Free Wi-Fi" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Free Wi-Fi</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Sarapan" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Sarapan</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Makan Siang" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Makan Siang</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Makan Malam" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Makan Malam</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Kamar Mandi" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Kamar Mandi</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Shower" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Shower</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Towels" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Towels</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Bedding" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Bedding</span>
                              </label>
                              <label class="form-selectgroup-item">
                                <input type="checkbox" name="layanan[]" value="Lainnya" class="form-selectgroup-input">
                                <span class="form-selectgroup-label">Lainnya</span>
                              </label>
                            </div>
            </div>
                        <div class="mb-3">
              <label class="form-label">Gambar</label>
              <input type="file" class="form-control" name="gambar[]" multiple>
            </div>
              <div class="mb-3">
              <label class="form-label">Thumbnail</label>
              <input type="file" class="form-control" name="imgPreview">
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

