@extends('layouts.app')

@section('content')
	<div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Master
                        </div>
                        <h2 class="page-title">
                            Jenis Fasilitas / Benefit
                        </h2>
                    </div>
					<!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a
									href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
									data-bs-target="#modal-room"
							>
                                <svg
										xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
										viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
										stroke-linecap="round" stroke-linejoin="round"
								>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Tambah Jenis Fasilitas / Benefit
                            </a>
                            <a
									href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
									data-bs-target="#modal-room" aria-label="Create new report"
							>
                                <svg
										xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
										viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
										stroke-linecap="round" stroke-linejoin="round"
								>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </a>
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
                        <h3 class="card-title">Daftar Jenis Fasilitas / Benefit</h3>
                    </div>
                    <div class="card-body">
                        <table class="table" data-export-title="Export" id="table1" width="100%">
                            <thead class="">
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="auto">Nama</th>
                                    <th width="115" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
	@include('facilities.modal-add-fasilitas')
	@include('facilities.modal-edit-fasilitas')
	<script>
        $(document).ready(function() {
           $('#btn-save').click(function() {
              var formData = $('#form-fasilitas').serialize();
              $.ajax({
                 url : "{{ route('fasilitas.store') }}",
                 type : 'POST',
                 data : formData,
                 headers : {
                    'X-CSRF-TOKEN' : $('input[name="_token"]').val()
                 },
                 success : function(response) {
                    Swal.fire({
                       title : "Success!",
                       text : "Data Berhasil Disimpan!",
                       icon : "success",
                       showConfirmButton : false,
                       timer : 900
                    }).then(function() {
                       $('#form-fasilitas').modal('hide');
                       $('#table1').DataTable().ajax.reload();
                       location.reload();
                    });

                 },
                 error : function(xhr) {
                    Swal.fire({
                       title : "Error!",
                       text : "Gagal",
                       icon : "error",
                       showConfirmButton : false,
                       timer : 900
                    });
                    console.log(xhr.responseText);
                 }
              });
           });

           //edit btn
           $('body').on('click', '.btn-edit', function() {
              var id = $(this).data('id');
              $.ajax({
                 type : "GET",
                 url : "{{ route('fasilitas.show', ':id') }}".replace(':id', id),
                 success : function(response) {
                    $('#editModal #id').val(response.id);
                    $('#editModal #EditNama').val(response.nama);
                    $('#editModal').modal('show');
                    console.log('Data berhasil Ditampilkan');
                 },
                 error : function(xhr, status, error) {
                    console.error('Gagal Load data untuk diedit:', error);
                 }
              });
           });
           $('#btn-update').click(function() {
              var id = $('#editModal #id').val();
              var nama = $('#editModal #EditNama').val();
              $.ajax({
                 type : "PUT",
                 url : "{{ route('fasilitas.update', ['id' => ':id']) }}".replace(':id', id),
                 data : {
                    _token : "{{ csrf_token() }}",
                    id : id,
                    nama : nama
                 },
                 success : function(response) {
                    console.log('Data berhasil diperbarui:', response);
                    Swal.fire({
                       icon : 'success',
                       title : 'Sukses!',
                       text : 'Data berhasil diperbarui.',
                       showConfirmButton : false,
                       timer : 2000
                    });
                    $('#editModal').modal('hide');
                    $('#table1').DataTable().ajax.reload();
                 },
                 error : function(xhr, status, error) {
                    console.error('Gagal memperbarui data kategori:', error);
                    Swal.fire({
                       icon : 'error',
                       title : 'Oops...',
                       text : 'Gagal memperbarui data. Silakan coba lagi.',
                    });
                 }
              });
           });

           $('body').on('click', '.btn-delete', function() {
              var id = $(this).data('id');

              Swal.fire({
                 title : 'Hapus Data',
                 text : "Anda Ingin Menghapus Data?",
                 icon : 'Peringatan',
                 showCancelButton : true,
                 confirmButtonText : 'Ya, Hapus'
              }).then((result) => {
                 if (result.isConfirmed) {
                    $.ajax({
                       url : '{{ route('fasilitas.destroy', ':id') }}'.replace(':id',
                          id),
                       type : 'DELETE',
                       data : {
                          _token : '{{ csrf_token() }}'
                       },
                       success : function(response) {
                          Swal.fire(
                             'Dihapus',
                             'Data Berhasil Dihapus',
                             'success'
                          );

                          $('#table1').DataTable().ajax.reload();
                       },
                       error : function(xhr) {
                          Swal.fire(
                             'Failed!',
                             'Error',
                             'error'
                          );
                          console.log(xhr.responseText);
                       }
                    });
                 }
              });
           });

           var dataTable = function() {
              var table = $('#table1');
              table.DataTable({
                 responsive : true,
                 serverSide : true,
                 bDestroy : true,
                 processing : true,
                 language : {
                    processing : '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                 },
                 serverSide : true,
                 ajax : "{{ route('fasilitas.index') }}",
                 columns : [
                    {
                       data : 'DT_RowIndex',
                       name : 'DT_RowIndex'
                    },
                    {
                       data : 'nama',
                       name : 'nama'
                    },
                    {
                       data : 'action',
                       name : 'action',
                       orderable : false,
                       searchable : false
                    },
                 ]
              });
           };
           dataTable();
        });
    </script>
@endsection
