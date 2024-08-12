@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Laporan
                        </div>
                        <h2 class="page-title">
                            Laporan Booking
                        </h2>
                    </div>
                    <!-- Page title actions -->

                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header text-white" style="background-color: #1F573A;">
                        <h3 class="card-title">Cari Laporan</h3>
                    </div>
                    <div class="card-body">
                        <!-- Filter Form -->
                             <form id="filterForm" class="row g-3 mb-4" method="POST" action="{{ route('laporan.cetak') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label for="checkIn" class="form-label">Tanggal Awal</label>
                                <input type="date" name="checkIn" id="checkIn" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="checkOut" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="checkOut" id="checkOut" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="checkOut" class="form-label">Status</label>
                                <select name="status" class="form-control" id="status">
                
                                        <option value="">Pilih Status</option>
                                        <option value="1">Menunggu Pembayaran</option>
                                        <option value="2">Dibayar</option>
                                        <option value="3">Belum Dikonfirmasi</option>
                                        <option value="4">Cancel Order</option>
                                        <option value="5">Sudah Checkout</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-primary" onclick="filterData()">Filter</button> &nbsp;
                                <button type="submit" class="btn btn-secondary">Cetak Laporan</button>
                            </div>
                        </form>

                        <!-- Table -->
                        <table class="table" data-export-title="Export" id="table1" width="100%">
                            <thead class="">
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="auto">Nama</th>
                                    <th width="auto">Email</th>
                                    <th width="auto">HP</th>

<th width="auto">Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimasukkan di sini melalui JavaScript -->
                            </tbody>
                        </table>

                        <!-- Print Button -->
                        <div class="text-end mt-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

function filterData() {
    const checkIn = document.getElementById('checkIn').value;
    const checkOut = document.getElementById('checkOut').value;
    const status = document.getElementById('status').value;
    const url = `{{ route('laporan.filter') }}?checkIn=${checkIn}&checkOut=${checkOut}&status=${status}`;

    const statusMapping = {
        1: 'Menunggu Pembayaran',
        2: 'Dibayar',
        3: 'Belum Dikonfirmasi',
        4: 'Cancel Order',
        5: 'Sudah Checkout'
    };

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#table1 tbody');
            tbody.innerHTML = '';
            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.NamaBooking}</td>
                    <td>${item.Email}</td>
                    <td>${item.hp}</td>
                `;

                if (item.Status !== undefined) {
                    row.innerHTML += `<td>${statusMapping[item.Status] || 'Tidak diketahui'}</td>`;
                }

                tbody.appendChild(row);
            });
        });
}


    </script>
@endsection
