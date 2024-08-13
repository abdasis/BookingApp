@extends('layouts.app')

@section('content')
    <x-page-header pretitle="Wahana" title="Data Wahana">
        <a href="{{ route('wahana.create') }}" class="btn btn-teal rounded-2">
            Tambah Wahana
        </a>
    </x-page-header>
    <x-page-body>
        @if (session()->has('success'))
            <div class="alert alert-important alert-success">{{ session()->get('success') }}</div>
        @endif
        <div class="card shadow-sm border-light-subtle rounded-3">
            <div class="card-body">
                <table id="wahana-table" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga Weekend</th>
                            <th>Harga Weekday</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </x-page-body>

    <script>
        $(function() {
            $("#wahana-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('wahana.all') }}',
                columns: [{
                        data: "id",
                        name: "id"
                    },
                    {
                        data: "nama",
                        name: "nama"
                    },
                    {
                        data: "deskripsi",
                        name: "deskripsi"
                    },
                    {
                        data: "harga_weekday",
                        name: "harga_weekday"
                    },
                    {
                        data: "harga_weekend",
                        name: "harga_weekend"
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
