@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-inner-group">

                <div class="card-inner">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            <img id="previewImage" src="{{ asset('') }}storage/foto/{{$foto}}" alt="Preview Foto" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #6B6EF5;">
                            <form id="uploadForm" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Pilih Foto Profil</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </form>
                           <div class="row mb-3">
                            <div class="containter">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalForm">Pilih Avatar</button>
                                <button type="button" class="btn btn-info" style="background-color: #6B6EF5;" id="uploadFoto">Upload</button>
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="text-center mb-3"><h6>Total Poin</h6></div>
                            <div class="text-center mb-3"><h4 style="color: #6B6EF5;">{{$total}}</h4></div>
                            <div class="user-card mb-3">
                                <div class="user-avatar bg-white">
                                    <img src="{{ asset('') }}assets/images/iconuser/pencil.png" alt="">
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{$PoinTulis}} Poin</span>
                                </div>
                            </div>
                            <div class="user-card mb-3">
                                <div class="user-avatar bg-white">
                                    <img src="{{ asset('') }}assets/images/iconuser/handshake.png" alt="">
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{$PoinKolab}} Poin</span>
                                </div>
                            </div>
                            <div class="user-card mb-3">
                                <div class="user-avatar bg-white">
                                    <img src="{{ asset('') }}assets/images/iconuser/share.png" alt="">
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{$PoinBagikan}} Poin</span>
                                </div>
                            </div>
                            <div class="user-card mb-3">
                                <div class="user-avatar bg-white">
                                    <img src="{{ asset('') }}assets/images/iconuser/like.png" alt="">
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{$PoinLike}} Poin</span>
                                </div>
                            </div>

                        </div>

                            <div class="col-sm">
                                <div class="row g-gs">
                                    @foreach ($LencanaTulis as $gambar)
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="gallery card">
                                            <a class="#">
                                                 <img class="w-100 rounded-top" src="{{ url('storage/lencana/'.$gambar->gambarLencana) }}" alt="">
                                            </a>
    <span class="text-center">{{$gambar->NamaLencana}}</span>
    <span class="text-center">{{$gambar->capaianPoin}}</span>
                                        </div>
                                    </div>
                                     @endforeach
                                    {{-- @if($lencana[0] == null)
                                    @else
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="gallery card">
                                            <a class="#">
                                            </a>
    <span class="text-center">{{$lencana[0]->NamaLencana}}</span>
    <span class="text-center">{{$lencana[0]->capaianPoin}}</span>
                                        </div>
                                    </div>
                                    @endif --}}
                                    @if($lencana[1] == null)
                                    @else
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="gallery card">
                                            <a class="#">
                                                <img class="w-100 rounded-top" src="{{ url('storage/lencana/'.$lencana[1]->gambarLencana) }}" alt="">
                                            </a>
    <span class="text-center">{{$lencana[1]->NamaLencana}}</span>
    <span class="text-center">{{$lencana[1]->capaianPoin}}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if($lencana[2] == null)
                                    @else
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="gallery card">
                                            <a class="#">
                                                <img class="w-100 rounded-top" src="{{ url('storage/lencana/'.$lencana[2]->gambarLencana) }}" alt="">
                                            </a>
    <span class="text-center">{{$lencana[2]->NamaLencana}}</span>
    <span class="text-center">{{$lencana[2]->capaianPoin}}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @if($lencana[3] == null)
                                    @else
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="gallery card">
                                            <a class="#">
                                                <img class="w-100 rounded-top" src="{{ url('storage/lencana/'.$lencana[3]->gambarLencana) }}" alt="">
                                            </a>
    <span class="text-center">{{$lencana[3]->NamaLencana}}</span>
    <span class="text-center">{{$lencana[3]->capaianPoin}}</span>
                                        </div>
                                    </div>
                                    @endif


                                </div>


                            </div>
                    </div>


                </div>

                <div class="card-inner">
                    <h6 class="overline-title mb-2">Pengguna Details</h6>
                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'name' => 'FormUser', 'id' => 'FormUser']) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Nomor Induk Pegawai:</strong>
            {!! Form::text('nip', null, array('placeholder' => 'NIP Anda','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Jabatan:</strong>
            {!! Form::text('jabatan', null, array('placeholder' => 'Jabatan Anda','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Unit Kerja:</strong>
            {!! Form::text('unitKerja', null, array('placeholder' => 'Unit Kerja Anda','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Instansi:</strong>
            {!! Form::text('instansi', null, array('placeholder' => 'Instansi Kerja Anda','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Password:</strong> <span class="text-danger">Kosongkan Jika Tidak Ingin Mengubah</span>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Confirm Password:</strong> <span class="text-danger">Kosongkan Jika Tidak Ingin Mengubah</span>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <br>
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'readonly' => 'readonly']) !!}

        </div>
    </div>

</div>
{!! Form::close() !!}
                <div class="col-12 mt-3 text-end">
                    <button type="button" class="btn btn-primary" style="background-color:#6b6ef5;" style="background-color: #6B6EF5;" id="btnSimpan">Simpan Perubahan</button>
                </div>
                </div><!-- .card-inner -->
            </div>
        </div>
    </div>
     {{-- modal add --}}
     <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Gunakan Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="form-avatar">
                        @csrf
<div class="row g-3">
    @foreach ($avatar as $key => $avatars)
    <div class="col-md-3 col-12">

                            <div class="preview-block">
                                <span class="preview-title overline-title"></span>
                                <div class="custom-control custom-radio image-control">
                                    <input type="radio" class="custom-control-input" value="{{$avatars->avatar}}" id="imageRadio{{$key+1}}" name="imageRadio">
                                    <label class="custom-control-label" for="imageRadio{{$key+1}}"><img src="{{url('storage/foto/'.$avatars->avatar)}} " width="150" height="150" alt=""></label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <button type="button" class="btn btn-primary btn-block" id="btn-save">Gunakan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#btnSimpan').on('click', function() {

            Swal.fire({
                title: 'Apakah Anda yakin ?',
                text: "Anda akan menyimpan perubahan data pengguna!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6B6EF5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = $('#FormUser').serialize();
                    $.ajax({
                        url: $('#FormUser').attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            Swal.fire('Berhasil!', 'Data pengguna berhasil diperbarui.', 'success');
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan data.', 'error');
                        }
                    });
                }
            });
        });
        $('#uploadFoto').on('click', function() {
        var inputFoto = $('#foto')[0].files[0];


            var formData = new FormData();
            formData.append('foto', inputFoto);

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);

            // Mengirim permintaan AJAX
            $.ajax({
                url: '{{ route("foto-profil.store") }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data', // Menentukan enctype
                success: function(response) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Foto berhasil diunggah!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                },
                error: function(xhr, status, error) {
                    //pesan error
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengunggah foto.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error(error);
                }
            });
    });
    $('#btn-save').click(function() {
                var formData = $('#form-avatar').serialize();
                $.ajax({
                    url: '{{ route("foto-profil.avatar-store") }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
    Swal.fire({
        title: "Sukses!",
        text: "Profile berhasil disimpan.",
        icon: "success",
        showConfirmButton: false,
        timer: 900
    }).then(function() {
        $('#modalForm').modal('hide');
        $('#form-avatar')[0].reset();
        setTimeout(function() {
            location.reload();
        }, 10);
    });
},

                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat Mengubah.",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 900
                        });
                        console.log(xhr.responseText);
                    }
                });
            });
    });

    </script>
@endsection
