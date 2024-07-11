@extends('layouts.app')


@section('content')
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
                text: '{{ $message }}',
            });
        </script>
    @endif
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
                            No Whatsapp
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modalForm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Tambah Nomor HP
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-room" aria-label="Create new report">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
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
                <div class="alert alert-info" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/info-circle -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 9h.01"></path>
                                <path d="M11 12h1v4h1"></path>
                            </svg>
                        </div>
                        <div>
                            Nomor Whatsapp / Hp Akan digunakan pada tombol whatsapp yang ada didalam sistem
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-header bg-azure">
                        <h3 class="card-title">Daftar User </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Whatsapp</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Data belum di isi</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $user->pemilik }}</td>
                                                <td>{{ $user->hp }}</td>
                                                <td>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['whatsapp.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    {!! $data->render() !!}


    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="position: absolute; top: 10px; right: 10px;">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'whatsapp.store', 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Pemilik Whatsapp:</strong>
                                {!! Form::text('pemilik', null, ['placeholder' => 'Nama Pemilik Nomor Whatsapp', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Nomor HP / Whatsapp:</strong>
                                {!! Form::text('hp', null, ['placeholder' => 'Nomor HP', 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer bg-light">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
