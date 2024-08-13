@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <x-page-header pretitle="Voucher" title="Daftar Voucher">
            <a href="{{ route('voucher.create') }}" class="btn btn-primary">+ Tambah</a>
        </x-page-header>
    </div>
    <x-page-body>
        @if (session()->has('success'))
            <div class="alert alert-important alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card shadow-sm border-light-subtle rounded-3">
            <div class="card-body">
                <table id="vouchers-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Voucher</th>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </x-page-body>
    <script>
        $(function() {
            $("#vouchers-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('vouchers.all') }}',
                columns: [{
                        data: "id",
                        name: "id"
                    },
                    {
                        data: "code",
                        name: "code"
                    },
                    {
                        data: "description",
                        name: "description"
                    },
                    {
                        data: "amount",
                        name: "amount"
                    },
                    {
                        data: "status",
                        name: "status"
                    },
                    {
                        data: "start_date",
                        name: "start_date"
                    },
                    {
                        data: "expired_date",
                        name: "expired_date"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
