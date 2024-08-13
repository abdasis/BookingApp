@extends('layouts.app')

@section('content')
    <style>
        .disabled-card {
            opacity: 0.5;
            pointer-events: none;
            background-color: #f5f5f5;
        }

        .text-danger {
            color: #dc3545;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
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
                <div class="card text-primary-fg mb-4" style="background-color: #1F573A;">
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
                        <h3 class="card-title">Pilih Room Kamar Yang Tersedia</h3>
                        <p>Booking Kamar Sekarang Juga</p>
                        <div class="form-selectgroup">
                            <div id="filters">
                                <label class="bg-dark">
                                    <input type="date" name="checkIn" id="checkIn" class="form-control">
                                </label>
                                <label class="bg-dark">
                                    <input type="date" name="checkOut" id="checkOut" class="form-control">
                                </label>


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
            $(document).ready(function() {
                const today = new Date().toISOString().split('T')[0];

                document.getElementById('checkIn').setAttribute('min', today);
                document.getElementById('checkOut').setAttribute('min', today);

                function loadRooms(checkIn = '', checkOut = '') {
                    $.ajax({
                        url: "{{ route('room.getroom') }}",
                        method: "GET",
                        data: {
                            checkIn: checkIn,
                            checkOut: checkOut
                        },
                        success: function(data) {
                            var roomsHtml = '';
                            $.each(data, function(index, room) {
                                roomsHtml += `
                         <div class="card mb-3 ${room.status.includes('Tidak Tersedia') ? 'disabled-card' : ''}">
    <div class="card-status-top status-top" style="background-color: #1F573A;"></div>
    <div class="row g-0">
        <div class="col-auto">
            <div class="card-body">
                <div class="avatar avatar-2xl" style="background-image: url({{ asset('storage/imgPreview/${room.imgPreview}') }}); background-color:#fffff;"></div>
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
                                ${room.tiperoom}
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
                                ${room.tiperoom}
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
                            ${room.Fasilitas.map(fasilitas1 => `<span class="badge badge-outline border fw-normal badge-pill bg-info text-white mb-1">${fasilitas1}</span>`).join(' ')}
                        </div>
                        ${room.status.includes('Tidak Tersedia') ? `<div class="mt-3 text-danger fw-bold">Room ini telah dipesan dari ${room.bookingCheckIn} hingga ${room.bookingCheckOut}</div>` : ''}
                        <div class="mt-1 text-end align-middle">
                            <button type="button" id="booknow" data-id="${room.id}" class="btn text-white" style="background-color: #1F573A;" ${room.status.includes('Tidak Tersedia') ? 'disabled' : ''}>Book Now</button>
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
                    // var tiperoom = [];
                    // $('input[name="type"]:checked').each(function() {
                    //     tiperoom.push($(this).val());
                    // });
                    var checkIn = $('#checkIn').val();
                    var checkOut = $('#checkOut').val();
                    // console.log('12312');
                    loadRooms(checkIn, checkOut);
                });

                loadRooms();
                $(document).on('click', '#booknow', function() {
                    var roomId = $(this).data('id');
                    var url = "{{ route('booking.create', ':id') }}";
                    url = url.replace(':id', roomId);
                    window.location.href = url;
                });

            });
        </script>
    @endsection
