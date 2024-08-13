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
                        <div class="row">
                            <div class="col-3">
                                <div class="input-icon mb-3">
                                    <select name="filterStatus" class="form-control" id="filterStatus">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Menunggu Pembayaran</option>
                                        <option value="2">Dibayar</option>
                                        <option value="3">Belum Dikonfirmasi</option>
                                        <option value="4">Cancel Order</option>
                                        <option value="5">Sudah Checkout</option>
                                    </select>
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-location">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M20.891 2.006l.106 -.006l.13 .008l.09 .016l.123 .035l.107 .046l.1 .057l.09 .067l.082 .075l.052 .059l.082 .116l.052 .096c.047 .1 .077 .206 .09 .316l.005 .106c0 .075 -.008 .149 -.024 .22l-.035 .123l-6.532 18.077a1.55 1.55 0 0 1 -1.409 .903a1.547 1.547 0 0 1 -1.329 -.747l-.065 -.127l-3.352 -6.702l-6.67 -3.336a1.55 1.55 0 0 1 -.898 -1.259l-.006 -.149c0 -.56 .301 -1.072 .841 -1.37l.14 -.07l18.017 -6.506l.106 -.03l.108 -.018z" />
                                        </svg> </span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-icon mb-3">
                                    <select name="filterJenis" class="form-control" id="filterJenis">
                                        <option value="">Pilih Jenis Booking</option>
                                        <option value="1">Booking Ditempat</option>
                                        <option value="2">Booking Online</option>
                                    </select>
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="currentColor"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-bookmark">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M14 2a5 5 0 0 1 5 5v14a1 1 0 0 1 -1.555 .832l-5.445 -3.63l-5.444 3.63a1 1 0 0 1 -1.55 -.72l-.006 -.112v-14a5 5 0 0 1 5 -5h4z" />
                                        </svg>
                                </div>
                            </div>
                        </div>
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
                            </tbody>
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
                    <img id="imagepreview" src="" alt="Bukti Pembayaran"
                        style="width:100%; height:auto; display: none;">
                    <div id="pesan" style="display: none;">Belum ada bukti pembayaran yang diunggah.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-konfirmasi"
                        data-bs-dismiss="modal">Konfirmasi Pembayaran</button>
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


        $('#btn-konfirmasi').click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('idbooking', $('#idbooking').val());
            formData.append('_token', $('#csrf-token').val());
            $.ajax({
                url: "{{ route('booking.konfirmasi', ['id' => ':id']) }}".replace(':id', $('#idbooking')
                    .val()),
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
                    serverSide: true,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                    },
                    ajax: {
                        url: "{{ route('booking.listBooking') }}",
                        data: function(d) {
                            d.filterStatus = $('#filterStatus').val(),
                                d.filterJenis = $('#filterJenis').val()
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
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

            jQuery(document).ready(function() {
                dataTable()
                $('#filterStatus,#filterJenis').change(function() {
                    var table1 = $('#table1').DataTable();
                    table1.draw();
                });
            });

        });
    </script>
@endsection
