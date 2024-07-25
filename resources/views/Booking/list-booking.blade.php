@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Master
                        </div>
                        <h2 class="page-title">
                            Daftar Pemesanan Room / Kamar
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">

            <div class="container-xl">

                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Daftar Pemesanan Room / Kamar</h3>
                    </div>
                    <div class="card-body">
                        <table class="table" data-export-title="Export" id="table1" width="100%">
                            <thead class="">
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="20%">Nama</th>
                                    <th width="5%" class="text-center">Email / Wa</th>
                                    <th width="5%">Jenis Kelamiin</th>
                                    <th width="20%">Check In</th>
                                    <th width="20%">Check Out</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Online</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                            </tbody >
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal modal-blur fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bukti Bayar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formkonfirmasi" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idbooking" id="idbooking">
                    </form>
                    <img id="imagepreview" src="" alt="Bukti Pembayaran" style="width:100%; height:auto; display: none;">
                    <div id="pesan" style="display: none;">Belum ada bukti pembayaran yang diunggah.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-konfirmasi" data-bs-dismiss="modal">Konfirmasi Pembayaran</button>
                </div>
            </div>
        </div>
    </div>



    <script>

     $('body').on('click', '.btn-bukti', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "{{ route('booking.getBukti', ':id') }}".replace(':id', id),
        success: function(response) {
            console.log(response.imageUrl);
            $('#modal-large #idbooking').val(response.id);
            if (response.imageUrl) {
                $('#modal-large #imagepreview').attr('src', response.imageUrl).show();
                $('#modal-large #pesan').hide();
            } else {
                $('#modal-large #imagepreview').hide();
                $('#modal-large #pesan').show();
            }
            $('#modal-large').modal('show');
            console.log('Data berhasil Ditampilkan');
        },
        error: function(xhr, status, error) {
            console.error('Gagal Load data untuk diedit:', error);
        }
    });
});


        $('#btn-konfirmasi').click(function(e){
        e.preventDefault();
         var formData = new FormData();
        formData.append('idbooking', $('#idbooking').val());
         formData.append('_token', $('#csrf-token').val());
        $.ajax({
            url: "{{ route('booking.konfirmasi', ['id' => ':id']) }}".replace(':id', $('#idbooking').val()),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Berhasil di Konfirmasi',
                    confirmButtonText: 'Oke'
                }).then(function() {
    $('#table1').DataTable().ajax.reload();
});
            },
            error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Pembayaran gagal diupdate. Silakan coba lagi.',
                confirmButtonText: 'Oke'
            });
            }
        });
    });
        $(document).ready(function() {
            $('body').on('click', '.btn-checkout', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi Checkout',
                text: 'Apakah Anda yakin ingin melakukan checkout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Checkout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('booking.checkout') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success'
                            });
                            if (response.success) {
                                location.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Checkout gagal:', error);
                            Swal.fire({
                                title: 'Oops...',
                                text: 'Checkout gagal. Silakan coba lagi.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
            $('#btn-save').click(function() {
                var formData = $('#form-fasilitas').serialize();
                $.ajax({
                    url: "{{ route('fasilitas.store') }}",
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Data Berhasil Disimpan!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 900
                        }).then(function() {
                            $('#form-fasilitas').modal('hide');
                            $('#table1').DataTable().ajax.reload();
                            location.reload();
                        });

                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: "Gagal",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 900
                        });
                        console.log(xhr.responseText);
                    }
                });
            });

            //edit btn
            $('body').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('fasilitas.show', ':id') }}".replace(':id', id),
                    success: function(response) {
                        $('#editModal #id').val(response.id);
                        $('#editModal #EditNama').val(response.nama);
                        $('#editModal').modal('show');
                        console.log('Data berhasil Ditampilkan');
                    },
                    error: function(xhr, status, error) {
                        console.error('Gagal Load data untuk diedit:', error);
                    }
                });
            });


            var dataTable = function() {
                var table = $('#table1');
                table.DataTable({
                    responsive: true,
                    serverSide: true,
                    bDestroy: true,
                    processing: true,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    serverSide: true,
                    ajax: "{{ route('booking.listBooking') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'NamaBooking',
                            name: 'NamaBooking'
                        },
                        {
                            data: 'Kontak',
                            name: 'Kontak'
                        },
                        {
                            data: 'Jk',
                            name: 'Jk'
                        },
                        {
                            data: 'checkIn',
                            name: 'checkIn'
                        },
                        {
                            data: 'checkOut',
                            name: 'checkOut'
                        },
                        {
                            data: 'StatusBooking',
                            name: 'StatusBooking'
                        },
                        {
                            data: 'Online',
                            name: 'Online'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            };
            dataTable();

        });
    </script>
@endsection
