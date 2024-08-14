@extends('layouts.app_welcome')

@section('content')
   <div
      class="overflow-hidden min-vh-100"
      style="background-image: url('/assets/img/wahana/17235659551.jpg'); background-size: cover; width: 100vw; height: 100vh; position: absolute; top: 0; left: 0"
   >
   <div class="row justify-content-center align-items-center h-100">
      <div class="col-md-3">
            <div class="card p-3 shadow border-light-subtle rounded-3">
               <div class="card-body">
                  <img
                     src="{{asset('assets/img/icon/basecamp.png')}}"
                     class="h-33 w-33 my-3 justify-content-center d-grid mx-auto"
                     alt=""
                  >
                  <h2 class="title text-teal mb-0 text-center">
                     Selamat Datang di Basecamp Military Lifestyle
                  </h2>
                  <p class="text-center">
                     Jangan lewatkan kesempatan untuk merasakan pengalaman yang tak akan terlupakan di Basecamp Military
                     Lifestyle.
                  </p>
                  <div class="hr-text">Main Menu</div>
                  <div class="d-grid gap-2">
                     <a href="{{ route('booking.checkout') }}" class="btn btn-light border-light-subtle btn-lg">
                        <img src="{{asset('assets/img/logo/logo.png')}}" alt="">
                        <span class="text-primary">
                           Booking Hotel
                        </span>
                     </a>
                     <a href="{{ route('wahana.daftarWahana') }}" class="btn btn-light border-light-subtle btn-lg">
                        <img src="{{asset('assets/img/logo/logo.png')}}" alt="">
                        <span class="text-primary">
                           Booking Wahana
                        </span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
   </div>
</div>
@endsection
