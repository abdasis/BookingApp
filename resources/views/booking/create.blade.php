@extends('layouts.app')

@section('content')
    <div class="page-wrapper mb-3">
        <div class="page-header d-print-none">
            <div class="container-xl">

                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Booking
                        </div>
                        <h2 class="page-title">
                            Booking Room / Kamar
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="card text-white" style="background-color: #1F573A;">
                        <div class="card-stamp">
                            <div class="card-stamp-icon bg-white text-primary">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Selesaikan Pemesanan Kamar</h3>
                            <p>Lengkapi Identitas Diri</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Detail Room / Kamar
                                </h3>
                                <div class="card-actions">
                                </div>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-5">Tipe Room</dt>
                                    <dd class="col-7">: <badge class="badge bg-warning text-white xl">
                                            {{ $getData->roomtypes->nama }}</badge>
                                    </dd>
                                    <dt class="col-5">Nama Room</dt>
                                    <dd class="col-7">: {{ $getData->nama }}</dd>
                                    <dt class="col-5">Deskripsi:</dt>
                                    <dd class="col-7">: {{ $getData->deskripsi }}</dd>
                                    @if ($isWeekend)
                                        <dt class="col-5">Weekend</dt>
                                        <dd class="col-7">: Rp. {{ number_format($getData->tarifWe, 0, ',', '.') }}</dd>
                                    @else
                                        <dt class="col-5">Weekdays</dt>
                                        <dd class="col-7">: Rp. {{ number_format($getData->tarifWd, 0, ',', '.') }}</dd>
                                    @endif
                                    <dt class="col-5">Fasilitas</dt>
                                    <dd class="col-7">:

                                        @foreach ($getData->Fasilitas as $item)
                                            <li class="badge bg-info text-white mb-2">{{ $item }}</li>
                                        @endforeach

                                    </dd>
                                    <dt class="col-5">Max Checkout</dt>
                                    <dd class="col-7">: {{ $getData->checkout }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card">
                            <div class="card-body">
                                <div id="carousel-indicators-thumb" class="carousel slide carousel-fade"
                                    data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-thumb">
                                        @foreach ($getData->fotoroom as $key => $detail)
                                            <button type="button" data-bs-target="#carousel-indicators-thumb"
                                                data-bs-slide-to="{{ $key }}"
                                                class="ratio ratio-4x3 @if ($key == 1) active
                                            @else @endif"
                                                style="background-image: url({{ asset('storage/gambar/' . $detail->gambar) }})"></button>
                                        @endforeach

                                    </div>
                                    <div class="carousel-inner">
                                        @foreach ($getData->fotoroom as $key => $detail2)
                                            <div
                                                class="carousel-item @if ($key == 1) active
                                            @else @endif">

                                                <img alt="" style="width: 100%; height: 600px; object-fit: cover;"
                                                    src="{{ asset('storage/gambar/' . $detail2->gambar) }}">

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        {{-- <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Detail Room / Kamar
                                </h3>
                                <div class="card-actions">
                                </div>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-5">Tipe Room</dt>
                                    <dd class="col-7">: <badge class="badge bg-warning text-white xl">
                                            {{ $getData->roomtypes->nama }}</badge>
                                    </dd>
                                    <dt class="col-5">Nama Room</dt>
                                    <dd class="col-7">: {{ $getData->nama }}</dd>
                                    <dt class="col-5">Deskripsi:</dt>
                                    <dd class="col-7">: {{ $getData->deskripsi }}</dd>
                                    @if ($isWeekend)
                                        <dt class="col-5">Weekend</dt>
                                        <dd class="col-7">: Rp. {{ number_format($getData->tarifWe, 0, ',', '.') }}</dd>
                                    @else
                                        <dt class="col-5">Weekdays</dt>
                                        <dd class="col-7">: Rp. {{ number_format($getData->tarifWd, 0, ',', '.') }}</dd>
                                    @endif
                                    <dt class="col-5">facilities</dt>
                                    <dd class="col-7">:
                                        @foreach ($getData->facilities as $item)
                                            <span class="badge bg-info text-white">{{ $item }}</span>
                                        @endforeach
                                    </dd>
                                    <dt class="col-5">Max Checkout</dt>
                                    <dd class="col-7">: {{ $getData->checkout }}</dd>
                                </dl>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-6">
                        <div class="row row-cards">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Identitas Diri</h3>
                                        <div class="row row-cards">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">No Identitas</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="KTP / SIM / Passport" maxlength="16"
                                                        name="NoIdentitas">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="NamaBooking"
                                                        placeholder="Nama Lengkap">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" placeholder="Email"
                                                        name="Email">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <div class="form-selectgroup">
                                                        <label class="form-selectgroup-item">
                                                            <input type="radio" name="Gender" value="L"
                                                                class="form-selectgroup-input" checked="">
                                                            <span
                                                                class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-gender-male">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                                    <path d="M19 5l-5.4 5.4" />
                                                                    <path d="M19 5h-5" />
                                                                    <path d="M19 5v5" />
                                                                </svg> Pria</span>
                                                        </label>
                                                        <label class="form-selectgroup-item">
                                                            <input type="radio" name="Gender" value="P"
                                                                class="form-selectgroup-input">
                                                            <span
                                                                class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-gender-female">
                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                        fill="none" />
                                                                    <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                                    <path d="M12 14v7" />
                                                                    <path d="M9 18h6" />
                                                                </svg> Wanita</span>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label">No HP / Whatsapp</label>
                                                    <input type="number" class="form-control" maxlength="13"
                                                        placeholder="Nomor Whatsapp" name="hp" value="Faker">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Check in</label>
                                                    <input type="date" class="form-control" placeholder="Check In"
                                                        name="checkIn">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Check Out</label>
                                                    <input type="date" class="form-control" placeholder="Check Out"
                                                        name="checkOut">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Jumlah Tamu</label>
                                                    <input type="number" class="form-control" name="jumlahTamu"
                                                        placeholder="Jumlah Tamu">
                                                    <input type="hidden" class="form-control" name="roomId"
                                                        value="{{ $getData->id }}">
                                                        <input type="hidden" class="form-control" name="NamaRoom"
                                                        value="{{ $getData->nama }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Detail Transaksi
                                </h3>
                                <div class="card-actions">

                                </div>
                            </div>
                            <div class="card-body">
                                <dl class="row">
                                    <dt class="col-5">Tipe Room</dt>
                                    <dd class="col-7">: <span class="badge bg-warning text-white xl">
                                            {{ $getData->roomtypes->nama }}</span>
                                    </dd>
                                    <dt class="col-5">Total Hari</dt>
                                    <dd class="col-7">: <span id="TotalHari"></span> Hari</dd>
                                    <dt class="col-5">Tarif:</dt>
                                    <dd class="col-7">: <span id="Tarif"></span></dd>
                                </dl>
                                <button id="btnBayarSekarang" class="custom-button">Booking Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('#btnBayarSekarang').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: "Apakah Anda yakin ingin melakukan booking?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, booking sekarang!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var token = $('meta[name="csrf-token"]').attr('content');
                        var data = {
                            _token: token,
                            NoIdentitas: $('input[name="NoIdentitas"]').val(),
                            NamaBooking: $('input[name="NamaBooking"]').val(),
                            Email: $('input[name="email"]').val(),
                            Gender: $('input[name="Gender"]:checked').val(),
                            hp: $('input[name="hp"]').val(),
                            checkIn: $('input[name="checkIn"]').val(),
                            checkOut: $('input[name="checkOut"]').val(),
                            jumlahTamu: $('input[name="jumlahTamu"]').val(),
                            roomId: $('input[name="roomId"]').val(),
                            NamaRoom: $('input[name="NamaRoom"]').val(),
                            tarifTotal: document.getElementById("Tarif").innerText,
                        };
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('booking.store') }}',
                            data: data,
                            success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Berhasil!',
                                'Selamat!, Room / Kamar Telah Terbooking',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '{{ route('booking.listBooking') }}';
                                }
                            });
                        },
                            error: function(xhr, status, error) {
                                console.error(error);
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat melakukan booking. Silakan coba lagi.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#booknow', function() {
                var roomId = $(this).data('id');
                var url = "{{ route('booking.create', ':id') }}";
                url = url.replace(':id', roomId);
                window.location.href = url;
            });
            $('input[name="checkIn"], input[name="checkOut"]').change(function() {
                var checkIn = $('input[name="checkIn"]').val();
                var checkOut = $('input[name="checkOut"]').val();

                var startDate = new Date(checkIn);
                var endDate = new Date(checkOut);
                var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                $('#TotalHari').text(diffDays);

                var tarifPerHari = {{ $isWeekend ? $getData->tarifWe : $getData->tarifWd }};
                var totalBayar = tarifPerHari * diffDays;

                $('#Tarif').text('Rp. ' + totalBayar.toLocaleString('id-ID'));
            });
        });
    </script>
@endsection
