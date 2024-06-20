   @extends('layouts.app')

   @section('content')
       <div class="container">
           <div class="row justify-content">
               <div class="col-md-12">
                   @if ($data->Status == 0)
                       <div class="card bg-danger text-primary-fg">
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
                               <h2 class="card-title">Menunggu Pembayaran</h2>
                           </div>
                       </div>
                   @elseif ($data->Status == 2)
                       <div class="card bg-warning text-primary-fg">
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
                               <h2 class="card-title">Menunggu Persetujuan.. Cek Email Secara Berkala</h2>
                           </div>
                       </div>
                   @else
                       <div class="card bg-success text-primary-fg">
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
                               <h2 class="card-title">Pembayaran Telah Berhasil, Selamat Menikmati Liburan</h2>
                           </div>
                       </div>
                   @endif

               </div>
               <div class="col-md-4 mt-3">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">
                               Detail
                           </h3>
                       </div>
                       <div class="card-body">
                           <dl class="row">
                               <dt class="col-5">#ID</dt>
                               <dd class="col-7">: #{{ $data->id }}</dd>
                               <dt class="col-5">Room</dt>
                               <dd class="col-7">: {{ $data->roomtypes->nama }}</dd>
                               <dt class="col-5">Check In:</dt>
                               <dd class="col-7">: {{ $data->checkIn }}</dd>
                               <dt class="col-5">Check Out:</dt>
                               <dd class="col-7">: {{ $data->checkOut }}</dd>
                           </dl>
<div class="accordion mb-2" id="accordion-example">
                               <div class="accordion-item">
                                   <h2 class="accordion-header" id="heading-1">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                           data-bs-target="#collapse-1" aria-expanded="false">

                                          <img src="{{ asset('assets/img/payments/1.png') }}"
                                                   width="100px">
                                       </button>
                                   </h2>
                                   <div id="collapse-1" class="accordion-collapse collapse"
                                       data-bs-parent="#accordion-example" style="">
                                       <div class="accordion-body pt-0">
                                           <strong>
                                               <p>12012983 a.n Alfin Aswr</p>
                                           </strong>
                                       </div>
                                   </div>
                               </div>
                               <div class="accordion-item">
                                   <h2 class="accordion-header" id="heading-2">
                                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                           data-bs-target="#collapse-2" aria-expanded="false">
                                           <img src="{{ asset('assets/img/payments/2.png') }}"
                                                   width="100px">
                                       </button>
                                   </h2>
                                   <div id="collapse-2" class="accordion-collapse collapse"
                                       data-bs-parent="#accordion-example" style="">
                                       <div class="accordion-body pt-0">

                                       </div>
                                   </div>
                               </div>
                           </div>

                           <form id="formbayar" enctype="multipart/form-data" method="POST">
                            @csrf
                               <input type="text" name="idbooking" id="idbooking" value="{{ $data->id }}">
                               <input type="file" name="file" id="file" class="form-control mb-2">
                            </form>
                           <button type="button" class="btn btn-primary" id="btn-update">Simpan Perubahan</button>

                       </div>
                   </div>

               </div>
               <div class="col-md-8 mt-3">
                   <div class="card">
                       <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                           <div class="divide-y">
                               @foreach ($history as $item)
                                   <div>
                                       <div class="row">
                                           <div class="col-auto">
                                               <span class="avatar">#{{ $item->id }}</span>
                                           </div>
                                           <div class="col">
                                               <div class="text-truncate">
                                                   Booking Room / Kamar <strong>{{ $item->roomtypes->nama }}</strong> pada
                                                   tanggal <strong>{{ $item->created_at }}</strong> post.
                                               </div>
                                               <div class="text-secondary"><span
                                                       class="badge bg-success text-white">Berhasil</span></div>
                                           </div>
                                           <div class="col-auto align-self-center">
                                               <div class="badge bg-green"></div>
                                           </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>


               </div>

           </div>
       </div>
<script>
     $(document).ready(function() {
                                   $('#btn-update').click(function() {
                                       updateData();
                                   });
                               });

                               function updateData() {

                                   var formData = new FormData($('#formbayar')[0]);
                                   $.ajax({
                                       type: "PUT",
                                       url: "{{ route('booking.update', ['id' => ':id']) }}".replace(':id', $('#idbooking').val()),
                                       data: formData,
                                       contentType: false,
                                       processData: false,
                                       success: function(response) {
                                           console.log('Data berhasil diperbarui:', response);
                                           Swal.fire({
                                               icon: 'success',
                                               title: 'Sukses!',
                                               text: 'Data berhasil diperbarui.',
                                               showConfirmButton: false,
                                               timer: 2000
                                           });
                                       },
                                       error: function(xhr, status, error) {
                                           console.error('Gagal memperbarui data:', error);
                                           Swal.fire({
                                               icon: 'error',
                                               title: 'Oops...',
                                               text: 'Gagal memperbarui data. Silakan coba lagi.'
                                           });
                                       }
                                   });
                               }
</script>
   @endsection
