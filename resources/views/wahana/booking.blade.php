@extends('layouts.app_welcome')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h5 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href=".">
                            <img src="{{ asset('assets/img/icon/basecamp.png') }}" width="1000" height="1000" alt="Tabler"
                                class="navbar-brand-image">
                        </a>
                        <span style="color: #1F573A; font-size: 18px">Basecamp Military Lifestyle</span>
                    </h5>
                    <p>Jalan Puncak Gadog No. 22 KM 75, Cipayung Data, Kecamatan Megamendung, Kab. Bogor</p>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">

                </div>
            </div>
        </div>
    </div>
    <x-page-body>
        <div class="card shadow-sm rounded-3 border-light-subtle">
            <div class="card-body">
                <form action="{{route('wahana-booking.store')}}" method="POST">
                    @csrf
                    <div class="row justify-content-between gap-3">
                        <div class="col-md-6">
                            <h2 class="title mt-5 mb-2">
                                Contact Detail
                            </h2>
                            <input type="hidden" name="wahana_id" value="{{$wahana->id}}" />
                            <div class="form-group row ">
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" required
                                        placeholder="Masukan Email" value="{{ old('email') }}">
                                </div>
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Nomor Telepon</label>
                                    <input type="text" id="telepon" class="form-control" name="telepon" required
                                        placeholder="Masukan Telepon" value="{{ old('telepon') }}">
                                </div>
                            </div>
                            <div class="alert alert-important border-1 border-success my-3 bg-success-lt" role="alert">
                                Data diatas dipastikan aktif karena untuk menerima konfirmasi pembayaran
                            </div>
                            <h2 class="title mt-5 mb-2">
                                Biodata Pengunjung
                            </h2>
                            <div class="form-group row">
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required
                                        placeholder="Masukan Nama Lengkap" value="{{ old('nama') }}">
                                </div>
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Nomor Identitas (SIM/KTP)</label>
                                    <input type="text" class="form-control" name="nomor_identitas" required
                                        placeholder="Masukan Nomor Identitas" value="{{ old('nomor_identitas') }}">
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form-selectgroup">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="gender" value="L" class="form-selectgroup-input"
                                            checked="">
                                        <span
                                            class="form-selectgroup-label"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-gender-male">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                <path d="M19 5l-5.4 5.4" />
                                                <path d="M19 5h-5" />
                                                <path d="M19 5v5" />
                                            </svg> Pria</span>
                                    </label>
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="gender" value="P" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-gender-female">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                <path d="M12 14v7" />
                                                <path d="M9 18h6" />
                                            </svg> Wanita</span>
                                    </label>

                                </div>
                            </div>
                            <h2 class="title mt-5 mb-2">
                                Diskon
                            </h2>
                            <div class="form-group row ">
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Tanggal Booking</label>
                                    <input type="date" class="form-control {{$errors->has('tanggal_booking') ? 'is-invalid' : ''}}" name="tanggal_booking"
                                           placeholder="Kode Voucher" value="{{ old('tanggal_booking') }}">
                                     <x-error-message error="tanggal_booking"/>
                                </div>
                                 <div class="col-sm-12 col-md-6">
                                    <label for="">Kode Voucher</label>
                                    <input type="text" class="form-control" name="diskon" required
                                        placeholder="Kode Voucher" value="{{ old('diskon') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="carousel-indicators-thumb" class="carousel border-danger slide carousel-fade"
                                data-bs-ride="carousel">
                                <div class="carousel-indicators carousel-indicators-thumb">
                                    @foreach (json_decode($wahana->galeries) as $key => $detail)
                                        <button type="button" data-bs-target="#carousel-indicators-thumb"
                                            data-bs-slide-to="{{ $key }}"
                                            class="ratio ratio-4x3 @if ($key == 0) active @else @endif"
                                            style="background-image: url({{ asset('assets/img/wahana/' . $detail) }})"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner overflow-hidden border border-light-subtle rounded-3"
                                    style="max-height: 300px">
                                    @foreach (json_decode($wahana->galeries) as $key => $galeri)
                                        <div class="carousel-item @if ($key == 0) active @else @endif">
                                            <img class="d-block align-center object-fit-contain" alt=""
                                                src="{{ asset('assets/img/wahana/' . $galeri) }}" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card border-light-subtle mt-3">
                                <div class="card-body">
                                    <h3 class="card-title fw-bold mb-0 text-teal">
                                        {{ $wahana->nama }}
                                    </h3>
                                    <p class="card-text">
                                        {{ $wahana->deskripsi }}
                                    </p>
                                </div>
                                <div class="card-body border-light pt-0">
                                    <div class="meta">
                                        <div class="badge badge-light">
                                            {{ now()->locale('id')->isoFormat('dddd') }}
                                        </div>
                                        <div class="badge badge-light">
                                            {{ now()->format('d-m-Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-light pt-0">
                                    <div class="d-flex justify-content-between">
                                        @if (now()->isWeekday())
                                            <div class="d-grid">
                                                <p class="mb-0">Harga Weekday</p>
                                                <h3 class="fw-semibold">{{ rupiah($wahana->harga_weekday) }}</h3>
                                            </div>
                                        @else
                                            <div class="d-grid">
                                                <p class="mb-0">Harga Weekend</p>
                                                <h3 class="fw-semibold">{{ rupiah($wahana->harga_weekend) }}</h3>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-teal">
                                            Book Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </x-page-body>
@endsection
