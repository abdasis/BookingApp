@extends('layouts.app_welcome')

@section('content')
    <x-page-body>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session()->has('success'))
                    <div class="alert alert-important alert-success">{{ session()->get('success') }}</div>
                @endif
                <div class="card shadow-sm rounded-2 border-light">
                    <div class="card-body border-light-subtle">
                        <h2 class="title text-teal mb-0">
                            Rincian Pemesanan
                        </h2>
                        <p class="text-muted">Berikut informasi pemesanan anda dan sekarang membutuhkan pembayaran yang harus
                            anda lakukan</p>
                    </div>
                    <div class="card-body border-light">
                        <table class="table-sm table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="text-muted">Kode Pemesanan</td>
                                    <td>#{{ $booking->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>{{ $booking->user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nomor Telepon</td>
                                    <td>{{ $booking->telepon }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td>{{ $booking->gender === 'L' ? 'Pria' : 'Wanita' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Booking</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d, F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Harga</td>
                                    <td>{{ rupiah($booking->total) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Diskon</td>
                                    <td>{{ $booking->jumlah_discount > 0 ? rupiah($booking->jumlah_discount) : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td>
                                        @if ($booking->status === 'pending')
                                            <div class="badge bg-warning-lt border-warning">
                                                Menunggu Pembayaran
                                            </div>
                                        @else
                                            <div class="badge bg-teal-lt border-teal">
                                                {{ $booking->status }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                        </table>
                        <div class="accordion border-light-subtle shadow-sm mb-2" id="accordion-payment">
                            <div class="accordion-item border-light-subtle">
                                <h2 class="accordion-header" id="heading-1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-1" aria-expanded="false">

                                        <img src="{{ asset('assets/img/payments/1.png') }}" width="100px">
                                    </button>
                                </h2>
                                <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-payment"
                                    style="">
                                    <div class="accordion-body pt-0">
                                        <strong>
                                            <p id="rekening">1260010177334</p>
                                            <p>Atas Nama Bukit Gading Mas</p>
                                            <button class="btn btn-light border-light-subtle btn-sm rounded-2"
                                                onclick="copyContent()">
                                                Salin Rekening</button>
                                        </strong>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                          <div class="card-body border-light">
                               <form id="formbayar" enctype="multipart/form-data" method="POST">
                               <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">
                               <input type="hidden" name="idbooking" id="idbooking" value="{{ $booking->id }}">
                               <div class="form-group">
                                   <label for="">Bukti Transfer</label>
                                   <input type="file" name="file" id="file" class="form-control mb-2">
                               </div>
                               <div class="d-grid gap-2 mt-3">
                                   <button type="button" id="submitPayment" class="btn btn-teal">Submit Payment</button>
                                   <a href="https://wa.me/{{ $booking->telepon }}?text=Halo%20konfirmasi%20pemesanan%20kamar%20Kode%20booking%20{{ $booking->id }}"
                                                                     target="blank" class="btn btn-light border-light-subtle">
                                   <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#00ff1e" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                       <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                       <path
                                          d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                                   </svg> Hubungi Kami
                               </a>
                               </div>
                           </form>
                          </div>

                </div>
            </div>
        </div>
    </x-page-body>
    <script>
        function copyContent() {
            const element = document.querySelector('#rekening');
            const storage = document.createElement('textarea');
            storage.value = element.innerHTML;
            element.appendChild(storage);
            storage.select();
            storage.setSelectionRange(0, 99999);
            document.execCommand('copy');
            element.removeChild(storage);
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Nomor rekening telah disalin.',
                confirmButtonText: 'Oke'
            });
        }
    </script>
@endsection
