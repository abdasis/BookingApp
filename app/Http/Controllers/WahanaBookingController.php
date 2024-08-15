<?php

namespace App\Http\Controllers;

use App\Http\Requests\WahanaBookingRequest;
use App\Interfaces\BookingRepsitoryInterface;
use App\Mail\BookingStatusMail;
use App\Models\BookingPayment;
use App\Models\User;
use App\Models\Voucher;
use App\Models\WahanaBooking;
use App\Wahana;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Mail;
use Yajra\DataTables\DataTables;

class WahanaBookingController extends Controller
{
   public function confirm($id)
   {
	  $payment = BookingPayment::where('wahana_booking_id', $id)->latest()->first();
	  $view = View::make('wahana.konfirmasi-pembayaran', [
		 'payment' => $payment
	  ])->render();
	  $response = [
		 'status' => 'success',
		 'message' => 'Data view berhasil diambil',
		 'view_content' => $view,
	  ];
	  
	  return response()->json($response);
   }
   
   public function storeConfirm(Request $request)
   {
	  $booking_id = $request->get('booking_id');
	  $booking = WahanaBooking::where('id', $booking_id)->first();
	  $booking->update([
		 'status' => 'paid'
	  ]);
	  return redirect()->back()->with('success', 'Pemesanan Berhasil Diconfirmasi');
   }
   
   public function update(Request $request, WahanaBooking $wahanaBooking)
   {
   }
   
   public function bookingWahana(DataTables $dataTables)
   {
	  $query = WahanaBooking::query()->with(['wahana', 'user', 'voucher']);
	  return $dataTables->eloquent($query)
		 ->order(function ($query) {
			$query->orderBy('tanggal_booking', 'desc');
		 })
		 ->addColumn('wahana', function (WahanaBooking $wahana) {
			return $wahana->wahana->nama;
		 })
		 ->editColumn('tanggal_booking', function (WahanaBooking $wahana) {
			return $wahana->created_at->format('d-m-Y');
		 })
		 ->addColumn('pengunjung', function (WahanaBooking $wahana) {
			return $wahana->user->name;
		 })
		 ->addColumn('email', function (WahanaBooking $wahana) {
			return $wahana->user->email;
		 })
		 ->addColumn('harga', function (WahanaBooking $wahana) {
			return rupiah($wahana->total);
		 })
		 ->addColumn('diskon', function (WahanaBooking $wahana) {
			$diskon = $wahana->jumlah_discount ?? 0;
			return rupiah($diskon);
		 })
		 ->addColumn('total', function (WahanaBooking $wahana) {
			$diskon = $wahana->jumlah_discount ?? 0;
			return rupiah($wahana->total - $diskon);
		 })
		 ->addColumn('status', function (WahanaBooking $wahana) {
			if ($wahana->status === 'paid') {
			   return "<span class='badge bg-success-lt border border-success'>Dibayar</span>";
			}
			
			if ($wahana->status === 'pending') {
			   return "<span class='badge bg-warning-lt border border-warning'>Menunggu Pembayaran</span>";
			}
			
			return "<span class='badge bg-danger-lt border border-danger badge-danger'>Dibatalkan</span>";
		 })
		 ->addColumn('jenis_booking', function (WahanaBooking $wahana) {
			if ($wahana->jenis_booking === 'online') {
			   return "<span class='status status-teal'>
					  <span class='status-dot status-dot-animated'></span>
					  Online
					</span>";
			}
			
			return "<span class='status status-primary'>
						  <span class='status-dot status-dot-animated'></span>
						  Offline
						</span>";
		 })
		 ->addColumn('action', function (WahanaBooking $wahana) {
			return view('partials.wahana-booking', compact('wahana'));
		 })
		 ->rawColumns(['action', 'status', 'jenis_booking'])
		 ->make(true);
   }
   
   public function index()
   {
	  
   }
   
   public function store(WahanaBookingRequest $request)
   {
	  try {
		 DB::beginTransaction();
		 //cek user
		 $check_user = User::where('email', $request->input('email'))->first();
		 if (!$check_user) {
			$generate_password = now()->format('dmY');
			$user['name'] = $request->input('nama');
			$user['email'] = $request->input('email');
			$user['password'] = Hash::make($generate_password);
			$user['role'] = 'Pengujung';
			$user = User::create($user);
			$user->assignRole('2');
		 } else {
			$user = User::where('email', $request->input('email'))->first();
			$user->password = Hash::make(now()->format('dmY'));
			$user->save();
		 }
		 
		 $visitor_id = User::where('email', $request->input('email'))->first()->id;
		 $wahana = Wahana::findOrFail($request->input('wahana_id'));
		 $voucher = Voucher::where('code', $request->input('diskon'))->first();
		 
		 $discount = 0;
		 if ($voucher) {
			$discount = $voucher->amount;
		 }
		 
		 if (now()->isWeekend()) {
			$total = $wahana->harga_weekend;
		 } else {
			$total = $wahana->harga_weekday;
		 }
		 
		 $booking = $request->all();
		 $booking['user_id'] = $visitor_id;
		 $booking['wahana_id'] = $request->input('wahana_id');
		 $booking['telepon'] = $request->input('telepon');
		 $booking['nomor_identitas'] = $request->input('nomor_identitas');
		 $booking['voucher_id'] = $voucher ? $voucher->id : null;
		 $booking['jumlah_discount'] = $discount;
		 $booking['total'] = $total;
		 $booking['discount'] = $discount;
		 $booking['jenis_booking'] = 'online';
		 $booking['tanggal_booking'] = now();
		 
		 $dataEmail = [
			'user' => $user,
			'password' => now()->format('dmY'),
			'booking' => $booking
		 ];
		 
		 Mail::to($user->email)->send(new BookingStatusMail($dataEmail));
		 $booking = app(BookingRepsitoryInterface::class)->create($booking);
		 
		 DB::commit();
		 return redirect()->route('wahana-booking.show', $booking->id)->with('success', 'Booking success');
	  } catch (Exception $exception) {
		 DB::rollBack();
		 dd($exception);
		 return redirect()->back()->with('error', $exception->getMessage());
	  }
   }
   
   public function create()
   {
   }
   
   public function show(WahanaBooking $wahanaBooking)
   {
	  return view('booking.show', [
		 'booking' => $wahanaBooking
	  ]);
   }
   
   public function edit(WahanaBooking $wahanaBooking)
   {
   }
   
   public function destroy(WahanaBooking $wahanaBooking)
   {
   }
}
