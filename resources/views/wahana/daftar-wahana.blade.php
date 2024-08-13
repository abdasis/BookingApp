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
    <div class="page-body">
        <div class="container-xl">
            <div class="card border-tabler banner-wrapper text-bg-tabler rounded-4">
                <div class="card-body p-5">
                    <h1>Selamat Datang</h1>
                    <p>Jangan lewatkan kesempatan untuk merasakan pengalaman yang tak akan terlupakan di Basecamp Military
                        Lifestyle. Kami menyediakan berbagai paket kegiatan yang dirancang khusus untuk Kamu yang ingin
                        merasakan bagaimana rasanya hidup dan bertahan ala militer. Mulai dari latihan fisik, navigasi alam,
                        hingga simulasi pertempuran—semua bisa Kamu rasakan di sini.</p>
                </div>
            </div>
            <h2 class="title my-5">
                Wahana Tersedia
            </h2>
            <div class="list-wahana py-2">
                @foreach ($data_wahana as $wahana)
                    <div class="card hover-shadow-sm shadow-sm border-light-subtle rounded-sm">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="image-wrapper col-3" style="">
                                    <img src="{{ asset('assets/img/wahana/' . json_decode($wahana->galeries)[0]) }}"
                                        alt="wahana" class="w-100 rounded-2 border-2 border-light-subtle">
                                </div>
                                <div class="meta-data col px-3">
                                    <h3 class="mb-0">{{ $wahana->nama }}</h3>
                                    <p>{{ $wahana->deskripsi }}</p>
                                    <div class="d-flex gap-3">
                                        <div class="d-grid">
                                            <p class="mb-0">Harga Weekday</p>
                                            <h3 class="fw-semibold">{{ rupiah($wahana->harga_weekday) }}</h3>
                                        </div>
                                        <div class="d-grid">
                                            <p class="mb-0">Harga Weekend</p>
                                            <h3 class="fw-semibold">{{ rupiah($wahana->harga_weekend) }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('wahana.book', $wahana->id) }}" class="btn btn-primary">Book
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
