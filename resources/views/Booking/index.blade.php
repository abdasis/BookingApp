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
                    <div class="col-auto ms-auto d-print-none">

                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card bg-primary text-primary-fg mb-4">
                    <div class="card-stamp">
                        <div class="card-stamp-icon bg-white text-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Pilih Room Kamar Yang Tersedia</h3>
                        <p>Booking Kamar Sekarang Juga</p>
                        <div class="form-selectgroup">
                            <div id="filters">
                                @foreach($type as $type)
                                <label class="bg-dark">
                                    <input type="checkbox" name="type" value="{{$type->id}}" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label">{{$type->nama}}</span>
                                </label>
                                <label class="bg-dark">
                                    <input type="date" name="checkIn" id="checkIn" class="form-control">
                                </label>
                                <div id="filters">

                                </div>
                                @endforeach

                            </div>
                        </div>
                        <br><br>
                        <div class="form-selectgroup">


                            <button id="apply-filters" class="btn btn-primary mb-3">Apply Filters</button>
                        </div>
                    </div>
                </div>

                <div id="rooms-list">
                    <!-- List kamar akan ditampilkan di sini -->
                </div>
            </div>


    </div>
    <script>
        $(document).ready(function () {

          function loadRooms(types = [], checkIn = '') {
        $.ajax({
            url: "{{ route('room.getroom') }}",
            method: "GET",
            data: { type: types, checkIn: checkIn },
            success: function(data) {
                var roomsHtml = '';
                $.each(data, function(index, room) {
                    roomsHtml += `
                        <div class="card mb-3">
    ${room.status == "1" ? `
    <div class="ribbon ribbon-top ribbon-bookmark bg-red sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" class="icon icon-tabler icons-tabler-filled icon-tabler-lock-square-rounded">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 2c-.218 0 -.432 .002 -.642 .005l-.616 .017l-.299 .013l-.579 .034l-.553 .046c-4.785 .464 -6.732 2.411 -7.196 7.196l-.046 .553l-.034 .579c-.005 .098 -.01 .198 -.013 .299l-.017 .616l-.004 .318l-.001 .324c0 .218 .002 .432 .005 .642l.017 .616l.013 .299l.034 .579l.046 .553c.464 4.785 2.411 6.732 7.196 7.196l.553 .046l.579 .034c.098 .005 .198 .01 .299 .013l.616 .017l.642 .005l.642 -.005l.616 -.017l.299 -.013l.579 -.034l.553 -.046c4.785 -.464 6.732 -2.411 7.196 -7.196l.046 -.553l.034 -.579c.005 -.098 .01 -.198 .013 -.299l.017 -.616l.005 -.642l-.005 -.642l-.017 -.616l-.013 -.299l-.034 -.579l-.046 -.553c-.464 -4.785 -2.411 -6.732 -7.196 -7.196l-.553 -.046l-.579 -.034a28.058 28.058 0 0 0 -.299 -.013l-.616 -.017l-.318 -.004l-.324 -.001zm0 4a3 3 0 0 1 2.995 2.824l.005 .176v1a2 2 0 0 1 1.995 1.85l.005 .15v3a2 2 0 0 1 -1.85 1.995l-.15 .005h-6a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 1.85 -1.995l.15 -.005v-1a3 3 0 0 1 3 -3zm3 6h-6v3h6v-3zm-3 -4a1 1 0 0 0 -.993 .883l-.007 .117v1h2v-1a1 1 0 0 0 -1 -1z" fill="#ffffff" stroke-width="0"/>
        </svg>
    </div>
    ` : `
    <div class="card-status-top status-top bg-primary"></div>
    `}
    <div class="row g-0">
        <div class="col-auto">
            <div class="card-body">
                <div class="avatar avatar-2xl" style="background-image: url({{asset('assets/img/icon/bedroom.png')}}); background-color:#fffff;"></div>
            </div>
        </div>
        <div class="col">
            <div class="card-body ps-0">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0"><a href="#">${room.nama}</a></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="mt-3 list-inline list-inline-dots mb-0 text-muted d-sm-block d-none">
                            <div class="list-inline-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                    <line x1="13" y1="7" x2="13" y2="7.01"></line>
                                    <line x1="17" y1="7" x2="17" y2="7.01"></line>
                                    <line x1="17" y1="11" x2="17" y2="11.01"></line>
                                    <line x1="17" y1="15" x2="17" y2="15.01"></line>
                                </svg>
                                ${room.roomtype}
                            </div>
                            <div class="list-inline-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11"></path>
                                    <line x1="9" y1="7" x2="13" y2="7"></line>
                                    <line x1="9" y1="11" x2="13" y2="11"></line>
                                </svg>
                                ${room.status}
                            </div>
                        </div>
                        <div class="mt-3 list mb-0 text-muted d-block d-sm-none">
                            <div class="list-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                    <line x1="13" y1="7" x2="13" y2="7.01"></line>
                                    <line x1="17" y1="7" x2="17" y2="7.01"></line>
                                    <line x1="17" y1="11" x2="17" y2="11.01"></line>
                                    <line x1="17" y1="15" x2="17" y2="15.01"></line>
                                </svg>
                                ${room.type}
                            </div>
                            <div class="list-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="11" r="3"></circle>
                                    <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                </svg>
                                ${room.id}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-3">
                            <p>${room.deskripsi}</p>
                        </div>
                        <div class="mt-3 badges">
                            <a href="#" class="badge badge-outline text-muted border fw-normal badge-pill">Fasilitas 1</a>
                            <a href="#" class="badge badge-outline text-muted border fw-normal badge-pill">Fasilitas 2</a>
                            <a href="#" class="badge badge-outline text-muted border fw-normal badge-pill">Fasilitas 3</a>
                        </div>
                        <div class="mt-3 text-end align-middle">
                             ${room.status == "1" ? `
                            <button type="button" id="booknow" disabled data-id="${room.id}" class="btn btn-danger">Telah di Booking</button>
                                ` : `
 <button type="button" id="booknow" data-id="${room.id}" class="btn btn-primary">Book Now</button>
    `}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                    `;
                });
                $('#rooms-list').html(roomsHtml);
            }
        });
    }

    $('#apply-filters').on('click', function() {
        var tiperoom = [];
        $('input[name="type"]:checked').each(function() {
            tiperoom.push($(this).val());
        });

        var checkIn = $('#checkIn').val();
        loadRooms(tiperoom, checkIn);
    });

    loadRooms();
            $(document).on('click', '#booknow', function() {
    var roomId = $(this).data('id');
    var url = "{{ route('booking.create', ':id') }}";
    url = url.replace(':id', roomId);
    window.location.href = url;
});


            dataTable();

        });
    </script>
@endsection
