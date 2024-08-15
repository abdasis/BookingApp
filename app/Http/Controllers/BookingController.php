<?php

namespace App\Http\Controllers;

use App\Mail\BookingStatusMail;
use App\Mail\BookingSukses;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Roomtype;
use App\Models\User;
use App\Models\WahanaBooking;
use App\Models\Whatsapp;
use App\Wahana;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
   public function loginuser(Request $request)
   {
	  $wa = Whatsapp::latest()->first();
	  return view('Auth.loginUser', compact('wa'));
   }
   
   public function index(Request $request)
   {
	  $type = Roomtype::all();
	  return view('booking.index', compact('type'));
   }
   
   public function listBooking(Request $request)
   {
	  if ($request->ajax()) {
		 $data = Booking::latest();
		 return DataTables::of($data)
			->addIndexColumn()
			->addColumn('action', function ($row) {
			   if ($row->Status == 2) {
				  $checkout = '<a href="javascript:void(0)" data-id="'.
							  $row->id.
							  '" class="btn btn-danger btn-md btn-checkout"><i class="fa-solid fa-door-closed"></i></a>';
				  $gambar = '<a href="javascript:void(0)" data-id="'.
							$row->id.
							'" class="btn btn-primary btn-md btn-bukti"><i class="fas fa-receipt"></i></a>';
				  return $gambar.'<br/><br/>'.$checkout;
			   }
			   
			   $gambar = '<a href="javascript:void(0)" data-id="'.
						 $row->id.
						 '" class="btn btn-primary btn-md btn-bukti"><i class="fas fa-receipt"></i></a>';
			   return $gambar;
			})
			->addColumn('Kontak', function ($row) {
			   return $row->Email.'<br>'.$row->hp;
			})
			->addColumn('StatusBooking', function ($row) {
			   if ($row->Status == 1) {
				  $StatusBooking = '<span class="badge bg-info text-white">Menunggu Pembayaran</span>';
			   } elseif ($row->Status == 2) {
				  $StatusBooking = '<span class="badge bg-success text-white">Dibayar</span>';
			   } else {
				  if ($row->Status == 3) {
					 $StatusBooking = '<span class="badge bg-warning text-white">Belum Dikonfirmasi</span>';
				  } else {
					 if ($row->Status == 4) {
						$StatusBooking = '<span class="badge bg-success text-white">Cancel Order</span>';
					 } else {
						$StatusBooking = '<span class="badge bg-danger text-white">Sudah Checkout</span>';
					 }
				  }
			   }
			   
			   return $StatusBooking;
			})
			->addColumn('Online', function ($row) {
			   if ($row->isOnline == 0) {
				  $Online = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#ff000d"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 1 0 0 1 1.32 -1.497z" /></svg>';
			   } else {
				  $Online = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#009e12"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.333 2c1.96 0 3.56 1.537 3.662 3.472l.005 .195v12.666c0 1.96 -1.537 3.56 -3.472 3.662l-.195 .005h-12.666a3.667 3.667 0 0 1 -3.662 -3.472l-.005 -.195v-12.666c0 -1.96 1.537 -3.56 3.472 -3.662l.195 -.005h12.666zm-2.626 7.293a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>';
			   }
			   return $Online;
			})
			->addColumn('Jk', function ($row) {
			   if ($row->Gender == 'P') {
				  $Jk = 'Pria';
			   } else {
				  $Jk = 'Wanita';
			   }
			   return $Jk;
			})
			->filter(function ($instance) use ($request) {
			   if ($request->get('filterStatus') && $request->get('filterStatus') !== '') {
				  $instance->where('Status', $request->get('filterStatus'));
			   }
			   if ($request->get('filterJenis') && $request->get('filterJenis') !== '') {
				  $instance->where('isOnline', $request->get('filterJenis'));
			   }
			   // if (!empty($request->get('search'))) {
			   //     $instance->where(function ($w) use ($request) {
			   //         $search = $request->get('search');
			   //         $w->orWhere('NamaBooking', 'LIKE', "%$search%")
			   //             ->orWhere('email', 'LIKE', "%$search%");
			   //     });
			   // }
			})
			->rawColumns(['action', 'Kontak', 'StatusBooking', 'Online', 'Jk'])
			->make(true);
	  }
	  return view('booking.list-booking');
   }
   
   public function bookingWahana(DataTables $dataTables)
   {
	  $query = WahanaBooking::query();
	  return $dataTables->eloquent($query)
		 ->addColumn('action', function (Wahana $wahana) {
			$editUrl = route('wahana.edit', $wahana);
			$deleteUrl = route('wahana.destroy', $wahana);
			return view('partials.wahana-actions', compact('editUrl', 'deleteUrl'));
		 })
		 ->make(true);
   }
   
   public function BookingOnline($id)
   {
	  $getData = Room::with('roomtypes')->where('id', $id)->first();
	  // dd($getData);
	  $today = Carbon::today();
	  $isWeekend = $today->isSaturday() || $today->isSunday();
	  return view('client.create', compact('getData', 'isWeekend'));
   }
   
   /**
	* Store a newly created resource in storage.
	*/
   public function store(Request $request)
   {
	  // dd('123123');
	  $tarifTotal = str_replace('Rp. ', '', $request->tarifTotal);
	  $tarifTotal = str_replace('.', '', $tarifTotal);
	  
	  //cek user
	  $cek = User::where('email', $request->Email)->first();
	  if (!$cek) {
		 $generatePassword = now()->format('dmY');
		 $input['name'] = $request->NamaBooking;
		 $input['email'] = $request->Email;
		 $input['password'] = Hash::make($generatePassword);
		 $input['role'] = 'Pengujung';
		 $user = User::create($input);
		 $user->assignRole('2');
	  } else {
		 $input = User::where('email', $request->Email)->first();
		 $input->password = Hash::make(now()->format('dmY'));
		 $input->save();
	  }
	  $idVisitor = User::where('email', $request->Email)->first()->id;
	  
	  $data2 = $request->all();
	  $data2['userId'] = $idVisitor;
	  $data2['Total'] = $tarifTotal;
	  $data2['Status'] = '2';
	  $data2['isOnline'] = '1';
	  $data = Booking::create($data2);
	  $data2['NamaRoom'] = $request->NamaRoom;
	  
	  // update status room
	  $query = Room::find($request->roomId);
	  $data1['status'] = '1';  // 0 = Available, 1=Booked
	  $query->update($data1);
	  
	  $dataEmail = [
		 'user' => $input,
		 'password' => now()->format('dmY'),
		 'booking' => $data2
	  ];
	  
	  Mail::to($request->Email)->send(new BookingStatusMail($dataEmail));
	  
	  return response()->json($data2);
   }
   
   /**
	* Show the form for creating a new resource.
	*/
   public function create($id)
   {
	  $getData = Room::with('roomtypes', 'fotoroom')->where('id', $id)->first();
	  // dd($getData);
	  $today = Carbon::today();
	  $isWeekend = $today->isSaturday() || $today->isSunday();
	  return view('booking.create', compact('getData', 'isWeekend'));
   }
   
   /**
	* Update the specified resource in storage.
	*/
   public function update(Request $request, $id)
   {
	  // dd(1);
	  $booking = Booking::find($id);
	  
	  if (!$booking) {
		 return response()->json(['message' => 'booking tidak ditemukan'], 404);
	  }
	  $gambar = $request->file('file');
	  $gambar->storeAs('public/booking', $gambar->getClientOriginalName());
	  $booking->Status = '3';
	  $booking->buktiBayar = $gambar->getClientOriginalName();
	  $booking->save();
	  
	  return response()->json(['message' => 'Data booking berhasil diperbarui', 'room' => $booking]);
   }
   
   public function onlinestore(Request $request)
   {
	  \Log::info($request->all());
	  // dd($generatePassword);
	  $tarifTotal = str_replace('Rp. ', '', $request->tarifTotal);
	  $tarifTotal = str_replace('.', '', $tarifTotal);
	  
	  $checkin = $request->checkIn.' '.$request->checkInTime;
	  $checkout = $request->checkOut.' '.$request->checkOutTime;
	  
	  //		cek user
	  $user = User::where('email', $request->email)->first();
	  if (!$user) {
		 $generatePassword = now()->format('dmY');
		 $input['name'] = $request->NamaBooking;
		 $input['email'] = $request->Email;
		 $input['password'] = Hash::make($generatePassword);
		 $input['role'] = 'Pengujung';
		 $user = User::create($input);
		 $user->assignRole('2');
	  } else {
		 $input = User::where('email', $request->Email)->first();
		 $input->password = Hash::make(now()->format('dmY'));
		 $input->save();
	  }
	  
	  // $idVisitor = User::where('email', $request->email)->first()->id;
	  $data2 = $request->all();
	  $data2['checkIn'] = $checkin;
	  $data2['checkOut'] = $checkout;
	  $data2['Total'] = $tarifTotal;
	  $data2['Status'] = '1';    // 1 = Menggungu Pembayaran, 2=Dibayar, 3=Menunggu Konfirmasi, 4=cancer Order, 5 = selesai
	  $data2['isOnline'] = '2';  // 1 = Offline booking, 2 = Online booking
	  $data = Booking::create($data2);
	  $data2['NamaRoom'] = $request->NamaRoom;
	  // dd($data2['NamaRoom'] = $request->NamaRoom);
	  // 0 = Offline booking, 1 = Online booking
	  // update status room
	  $query = Room::find($request->roomId);
	  $data1['status'] = '2';  // 1 = Available, 2=Booked
	  $query->update($data1);
	  
	  $dataEmail = [
		 'user' => $user,
		 'password' => now()->format('dmY'),
		 'booking' => $data2
	  ];
	  Mail::to($user->email)->send(new BookingStatusMail($dataEmail));
	  $history = Booking::with('roomtypes')->where('Email', $request->Email)->orderBy('id', 'desc')->first()->id;
	  $url = route('booking.book-payment', $history);
	  
	  // dd($history);
	  return response()->json(['url' => $url]);
   }
   
   /**
	* Display the specified resource.
	*/
   public function show()
   {
	  $data = Booking::with('roomtypes')->where('userId', auth()->id())->latest()->first();
	  $history = Booking::with('roomtypes')->where('userId', auth()->user()->id)->where('Status', '1')->get();
	  // dd($data);
	  return view('client.payment', compact('data', 'history'));
   }
   
   public function getBukti($id)
   {
	  
	  $booking = Booking::find($id);
	  if ($booking) {
		 $namafile = $booking->buktiBayar;
		 // dd($namafile);
		 if ($namafile) {
			$imageUrl = asset('storage/booking/'.$namafile);
			// dd($imageUrl);
			return response()->json([
			   'id' => $booking->id,
			   'imageUrl' => $imageUrl,
			]);
		 }
		 
		 return response()->json([
			'id' => $booking->id,
			'message' => 'Belum ada bukti pembayaran yang diunggah.',
		 ]);
	  }
	  
	  return response()->json(['error' => 'booking tidak ditemukan'], 404);
   }
   
   /**
	* Show the form for editing the specified resource.
	*/
   public function edit(Booking $booking)
   {
	  //
   }
   
   public function BookingPayment($id)
   {
	  $data = Booking::with('roomtypes')->where('id', $id)->first();
	  $checkin = Carbon::parse($data->checkIn);
	  $checkout = Carbon::parse($data->checkOut);
	  $lamahari = $checkin->diffInDays($checkout);
	  $date = $checkin;
	  if ($date->isWeekend()) {
		 $totalbayar = (float) $data?->roomtypes->tarifWe;
	  } else {
		 $totalbayar = (float) $data?->roomtypes->tarifWd;
	  }
	  $totalbayar = $totalbayar * $lamahari;
	  $wa = whatsapp::latest()->first();
	  return view('client.booking-payment', compact('data', 'wa', 'lamahari', 'totalbayar'));
   }
   
   public function konfirmasi(Request $request, $id)
   {
	  $booking = Booking::with('roomtypes')->find($id);
	  if (!$booking) {
		 return response()->json(['message' => 'booking tidak ditemukan'], 404);
	  }
	  
	  $Email = $booking->Email;
	  $cek = User::where('email', $Email)->first();
	  if (!$cek) {
		 $generatePassword = now()->format('dmY');
		 $input['name'] = $booking->NamaBooking;
		 $input['email'] = $booking->Email;
		 $input['password'] = Hash::make($generatePassword);
		 $input['role'] = 'Pengujung';
		 $user = User::create($input);
		 $user->assignRole('2');
	  } else {
		 $user = User::where('email', $Email)->first();
		 $user->password = Hash::make(now()->format('dmY'));
		 $user->save();
	  }
	  
	  $booking->userId = $user->id;
	  $booking->Status = '2';
	  $booking->save();
	  
	  Mail::to($booking->Email)->send(new BookingSukses($booking));
	  return response()->json(['message' => 'Data booking berhasil diperbarui', 'room' => $booking]);
	  
   }
   
   public function checkout(Request $request)
   {
	  $booking = Booking::find($request->id);
	  if (!$booking) {
		 return response()->json(['message' => 'booking tidak ditemukan', 'success' => false], 404);
	  }
	  $booking->status = '5';  // checkout
	  $booking->save();
	  
	  return response()->json(['message' => 'Checkout berhasil', 'success' => true]);
   }
   
   public function destroy(Booking $booking)
   {
	  
   }
}
