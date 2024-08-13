@extends('layouts.app')

@section('content')
    <x-page-header pretitle="Wahanah" title="Tambah Data Wahana" />
    <x-page-body>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-light-subtle rounded-3">
                    <div class="card-body">
                        <form action="{{ route('wahana.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                                    name="nama" required placeholder="Masukan nama wahana" value="{{ old('nama') }}">
                                <x-error-message error="name" />
                            </div>
                            <div class="form-group">
                                <label for="">Harga Weekday</label>
                                <input type="text" value="{{ old('harga_weekday') }}"
                                    class="form-control {{ $errors->has('harga_weekday') ? 'is-invalid' : '' }}"
                                    name="harga_weekday" required placeholder="0,0">
                                <x-error-message error="harga_weekday" />

                            </div>
                            <div class="form-group">
                                <label for="">Harga Weekend</label>
                                <input type="text" value="{{ old('harga_weekend') }}"
                                    class="form-control {{ $errors->has('harga_weekend') ? 'is-invalid' : '' }}"
                                    name="harga_weekend" required placeholder="0,0">
                                <x-error-message error="harga_weekend" />

                            </div>
                            <div class="form-group">
                                <label for="">Keterangan (Optional)</label>
                                <textarea name="deskripsi" class="form-control" cols="30" rows="6" placeholder="Keterangan wahana">{{ old('deskripsi') }}</textarea>
                                <x-error-message error="deskripsi" />
                            </div>
                            <div class="form-group">
                                <label for="status">Gambar</label>
                                <input type="file" class="form-control" multiple id="gambar" name="galeries[]">
                                <small class="text-muted">*Kamu dapat memilih lebih dari satu gambar</small>
                                <div id="preview-gambar" class="mt-3"></div>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-teal rounded-2">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-page-body>
    <script>
        const gambarInput = document.getElementById('gambar');
        const previewGambar = document.getElementById('preview-gambar');
        gambarInput.addEventListener('change', function() {
            const files = this.files;
            const fileList = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.width = 100;
                    img.height = 100;
                    fileList.push(img);
                };

                reader.readAsDataURL(file);
            }


            previewGambar.innerHTML = '';
            fileList.forEach(function(img) {
                previewGambar.appendChild(img);
            });
        });
    </script>
@endsection
