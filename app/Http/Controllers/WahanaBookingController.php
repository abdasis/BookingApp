<?php

namespace App\Http\Controllers;

use App\Http\Requests\WahanaBookingRequest;
use App\Interfaces\BookingRepsitoryInterface;
use App\Models\User;
use App\Models\Voucher;
use App\Models\WahanaBooking;
use App\Wahana;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WahanaBookingController extends Controller
{
	public function index()
	{

	}

	public function store(WahanaBookingRequest $request)
	{
		try {
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
			$voucher = Voucher::where('code', $request->input('voucher'))->first();

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

			//			$dataEmail = [
			//				'user' => $input,
			//				'password' => now()->format('dmY'),
			//				'booking' => $data2
			//			];
			//
			//			Mail::to($request->Email)->send(new BookingStatusMail($dataEmail));
			$booking = app(BookingRepsitoryInterface::class)->create($booking);

			return redirect()->route('wahana-booking.show', $booking->id)->with('success', 'Booking success');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', $exception->getMessage());
		}
	}

	public function create()
	{
	}

	public function update(Request $request, WahanaBooking $wahanaBooking)
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
