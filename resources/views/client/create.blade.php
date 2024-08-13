@extends('layouts.app_client')

@section('content')
   <div class="page-wrapper mb-3">
	  <div class="page-header d-print-none">
		 <div class="container-xl">
			
			<div class="row g-2 align-items-center">
			   <div class="col">
				  <!-- Page pre-title -->
				  <h5 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
					 <a href=".">
						<img
							src="{{ asset('assets/img/icon/basecamp.png') }}" width="1000" height="1000" alt="Tabler"
							class="navbar-brand-image"
						>
					 </a>
					 <span style="color: #1F573A; font-size: 18px">Basecamp Military Lifestyle</span>
				  </h5>
				  <p>Jalan Puncak Gadog No. 22 KM 75, Cipayung Data, Kecamatan Megamendung, Kab. Bogor</p>
			   </div>
			   <!-- Page title actions -->
			   <div class="col-auto ms-auto d-print-none">
			   
			   </div>
			</div>
			<!-- Page title actions -->
			<div class="card bg-success text-primary-fg">
			   <div class="card-stamp">
				  <div class="card-stamp-icon bg-white text-primary">
					 <!-- Download SVG icon from http://tabler-icons.io/i/star -->
					 <svg
						 xmlns="http://www.w3.org/2000/svg"
						 class="icon"
						 width="24"
						 height="24"
						 viewBox="0 0 24 24"
						 stroke-width="2"
						 stroke="currentColor"
						 fill="none"
						 stroke-linecap="round"
						 stroke-linejoin="round"
					 >
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
					 </svg>
				  </div>
			   </div>
			   <div class="card-body" style="background-color: #1F573A;">
				  <h3 class="card-title">Petunjuk Pemesanan Room / Kamar</h3>
				  <p></p>
				  <ul>
					 <li>Lengkap data dalam form booking / jangan ada yang dikosongkan</li>
					 <li>Selanjutnya klik <b>Booking Sekarang</b></li>
					 <li>Cek email yang anda gunakan dalam form pemesanan</b></li>
					 <li>Username dan Password akan diberikan oleh sistem untuk meneruskan pesanan anda ke proses pembayaran</b></li>
				  </ul>
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
			   <div class="card" style="height: 100%;">
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
						<dd class="col-7">:
						   <badge class="badge bg-warning text-white xl">
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
			   <div class="card" style="height: 100%;">
				  
				  <div class="card-body">
					 <div
						 id="carousel-indicators-thumb" class="carousel slide carousel-fade"
						 data-bs-ride="carousel"
					 >
						<div class="carousel-indicators carousel-indicators-thumb">
						   @foreach ($getData->fotoroom as $key => $detail)
							  <button
								  type="button" data-bs-target="#carousel-indicators-thumb"
								  data-bs-slide-to="{{ $key }}"
								  class="ratio ratio-4x3 @if ($key == 1) active
                                            @else @endif"
								  style="background-image: url({{ url('storage/gambar/' . $detail->gambar) }})"
							  ></button>
						   @endforeach
						
						</div>
						<div class="carousel-inner">
						   @foreach ($getData->fotoroom as $key => $detail2)
							  <div
								  class="carousel-item @if ($key == 1) active
                                            @else @endif"
							  >
								 
								 <img
									 alt="" style="width: 100%; height: 100%; object-fit: cover;"
									 src="{{ url('storage/gambar/' . $detail2->gambar) }}"
								 >
							  
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
			
			<div class="col-sm-8">
			   <div class="row row-cards">
				  <div class="col-12">
					 <div class="card">
						<div class="card-body">
						   <h3 class="card-title">Identitas Diri</h3>
						   <div class="row row-cards">
							  <div class="col-md-4">
								 <div class="mb-3">
									<label class="form-label">No Identitas</label>
									<input
										type="number" class="form-control"
										placeholder="KTP / SIM / Passport" maxlength="16"
										name="NoIdentitas"
									>
								 </div>
							  </div>
							  <div class="col-sm-6 col-md-4">
								 <div class="mb-3">
									<label class="form-label">Nama Lengkap</label>
									<input
										type="text" class="form-control" name="NamaBooking"
										placeholder="Nama Lengkap"
									>
								 </div>
							  </div>
							  <div class="col-sm-6 col-md-4">
								 <div class="mb-3">
									<label class="form-label">Email</label>
									<input
										type="email" class="form-control" placeholder="Email"
										name="Email"
									>
								 </div>
							  </div>
							  <div class="col-sm-6 col-md-4">
								 <div class="mb-3">
									<label class="form-label">Jenis Kelamin</label>
									<div class="form-selectgroup">
									   <label class="form-selectgroup-item">
										  <input
											  type="radio" name="Gender" value="L"
											  class="form-selectgroup-input" checked=""
										  >
										  <span
											  class="form-selectgroup-label"
										  ><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                                                <svg
																	xmlns="http://www.w3.org/2000/svg" width="24"
																	height="24" viewBox="0 0 24 24" fill="none"
																	stroke="currentColor" stroke-width="2"
																	stroke-linecap="round" stroke-linejoin="round"
																	class="icon icon-tabler icons-tabler-outline icon-tabler-gender-male"
																>
                                                                    <path
																		stroke="none" d="M0 0h24v24H0z"
																		fill="none"
																	/>
                                                                    <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                                                    <path d="M19 5l-5.4 5.4" />
                                                                    <path d="M19 5h-5" />
                                                                    <path d="M19 5v5" />
                                                                </svg> Pria</span>
									   </label>
									   <label class="form-selectgroup-item">
										  <input
											  type="radio" name="Gender" value="P"
											  class="form-selectgroup-input"
										  >
										  <span
											  class="form-selectgroup-label"
										  >
                                                                <svg
																	xmlns="http://www.w3.org/2000/svg" width="24"
																	height="24" viewBox="0 0 24 24" fill="none"
																	stroke="currentColor" stroke-width="2"
																	stroke-linecap="round" stroke-linejoin="round"
																	class="icon icon-tabler icons-tabler-outline icon-tabler-gender-female"
																>
                                                                    <path
																		stroke="none" d="M0 0h24v24H0z"
																		fill="none"
																	/>
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
									<input
										type="number" class="form-control" maxlength="13"
										placeholder="Nomor Whatsapp" name="hp" value="Faker"
									>
								 </div>
							  </div>
							  <div class="col-md-6">
								 <div class="mb-3">
									<label class="form-label">Check in</label>
									<div class="input-group">
									   <input
										   type="date" class="form-control" placeholder="Check In"
										   name="checkIn"
									   >
									   <input
										   type="time" class="form-control" placeholder="Check In"
										   name="checkInTime"
									   >
									</div>
								 </div>
							  </div>
							  <div class="col-md-6">
								 <div class="mb-3">
									<label class="form-label">Check Out</label>
									<div class="input-group">
									   <input
										   type="date" class="form-control" placeholder="Check In"
										   name="checkOut"
									   >
									   <input
										   type="time" class="form-control" placeholder="Check In"
										   name="checkOutTime"
									   >
									</div>
								 </div>
							  </div>
							  <div class="col-sm-6 col-md-12">
								 <div class="mb-3">
									<label class="form-label">Jumlah Tamu</label>
									<input
										type="number" class="form-control" name="jumlahTamu"
										placeholder="Jumlah Tamu"
									>
									<input
										type="hidden" class="form-control" name="roomId"
										value="{{ $getData->id }}"
									>
									<input
										type="hidden" class="form-control" name="NamaRoom"
										value="{{ $getData->nama }}"
									>
								 </div>
							  </div>
						   
						   </div>
						</div>
					 
					 </div>
				  </div>
			   </div>
			</div>
			<div class="col-sm-4">
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
						<dt class="col-5">Discount:</dt>
						<dd class="col-7">: <span id="discount"></span></dd>
						<dt class="col-5">Grand Total:</dt>
						<dd class="col-7">: <span id="grand-total"></span></dd>
					 </dl>
					 <div class="form-group my-4">
						<label>Kode Diskon</label>
						<input
							type="text"
							class="form-control"
							id="voucher"
							placeholder="Punya Voucher?"
							name="voucher"
						>
					 </div>
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
		 $("#btnBayarSekarang").click(function(e) {
			e.preventDefault();
			var NoIdentitas = $("input[name=\"NoIdentitas\"]").val();
			var NamaBooking = $("input[name=\"NamaBooking\"]").val();
			var Email = $("input[name=\"email\"]").val();
			var Gender = $("input[name=\"Gender\"]:checked").val();
			var hp = $("input[name=\"hp\"]").val();
			var checkIn = $("input[name=\"checkIn\"]").val();
			var checkInTime = $("input[name=\"checkInTime\"]").val();
			var checkOut = $("input[name=\"checkOut\"]").val();
			var checkOutTime = $("input[name=\"checkOutTime\"]").val();
			var jumlahTamu = $("input[name=\"jumlahTamu\"]").val();
			var roomId = $("input[name=\"roomId\"]").val();
			var NamaRoom = $("input[name=\"NamaRoom\"]").val();
			var tarifTotal = document.getElementById("grand-total").innerText;
			
			/*  if (!NoIdentitas || !NamaBooking || !Email || !Gender || !hp || !checkIn || !checkInTime || !checkOut || !checkOutTime || !jumlahTamu || !roomId || !NamaRoom || !tarifTotal) {
			 Swal.fire(
			 "Gagal!",
			 "Data Belum Lengkap. Silakan Lengkapi Data Diri Anda.",
			 "error"
			 );
			 return;
			 }*/
			
			Swal.fire({
			   title: "Konfirmasi",
			   text: "Apakah Anda yakin ingin melakukan booking?",
			   icon: "warning",
			   showCancelButton: true,
			   confirmButtonColor: "#3085d6",
			   cancelButtonColor: "#d33",
			   confirmButtonText: "Ya, booking sekarang!"
			}).then((result) => {
			   if (result.isConfirmed) {
				  var token = $("meta[name=\"csrf-token\"]").attr("content");
				  var data = {
					 _token: token,
					 NoIdentitas: NoIdentitas,
					 NamaBooking: NamaBooking,
					 Email: Email,
					 Gender: Gender,
					 hp: hp,
					 checkIn: checkIn,
					 checkInTime: checkInTime,
					 checkOut: checkOut,
					 checkOutTime: checkOutTime,
					 jumlahTamu: jumlahTamu,
					 roomId: roomId,
					 NamaRoom: NamaRoom,
					 tarifTotal: tarifTotal
				  };
				  $.ajax({
					 type: "POST",
					 url: '{{ route('booking.onlinestore') }}',
					 data: data,
					 success: function(response) {
						console.log(response);
						Swal.fire(
							"Berhasil!",
							"email dan Passwprd Anda Telah Dikirim, Periksa email Anda Secara Berkala",
							"success"
						).then((result) => {
						   if (result.isConfirmed) {
							  window.location.href = response.url;
						   }
						});
					 },
					 error: function(xhr, status, error) {
						console.error(error);
						Swal.fire(
							"Gagal!",
							"Terjadi kesalahan saat melakukan booking. Silakan coba lagi.",
							"error"
						);
					 }
				  });
			   }
			});
		 });
		 
		 
		 let tarif_number = 0;
		 $(document).on("click", "#booknow", function() {
			var roomId = $(this).data("id");
			var url = "{{ route('booking.create', ':id') }}";
			url = url.replace(":id", roomId);
			window.location.href = url;
		 });
		 $("input[name=\"checkIn\"], input[name=\"checkOut\"]").change(function() {
			var checkIn = $("input[name=\"checkIn\"]").val();
			var checkOut = $("input[name=\"checkOut\"]").val();
			
			var startDate = new Date(checkIn);
			var endDate = new Date(checkOut);
			var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
			var diffDays = Math.ceil(timeDiff / (
				1000 * 3600 * 24));
			
			$("#TotalHari").text(diffDays);
			
			var tarifPerHari = {{ $isWeekend ? $getData->tarifWe : $getData->tarifWd }};
			var totalBayar = tarifPerHari * diffDays;
			tarif_number = totalBayar;
			
			$("#Tarif").text("Rp. " + totalBayar.toLocaleString("id-ID"));
		 });
		 
		 $("#voucher").change(() => {
			let voucher = $("#voucher").val();
			getVoucher(voucher).then((response) => {
			   let totalBayar = tarif_number - response.amount;
			   $("#Tarif").text("Rp. " + tarif_number.toLocaleString("id-ID"));
			   $("#discount").text("Rp. " + response.amount.toLocaleString("id-ID"));
			   $("#grand-total").text("Rp. " + totalBayar.toLocaleString("id-ID"));
			}).catch((error) => {
			   console.error(error);
			});
		 });
		 
	  });
	  
	  function getVoucher(voucher) {
		 return $.ajax({
			type: "get",
			url: "{{ route('vouchers.getVocher', ['code' => ':code']) }}".replace(":code", voucher),
			data: {}
		 });
	  }
   </script>
@endsection
