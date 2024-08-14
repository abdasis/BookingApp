<?php

namespace App\Http\Controllers;

use App\Models\BookingPayment;
use Exception;
use Illuminate\Http\Request;

class BookingPaymentController extends Controller
{
	public function index()
	{

	}

	public function store(Request $request)
	{
		try {
			if ($request->hasFile('bukti')) {
				$file = $request->file('bukti');
				$fileName = time().'.'.$file->extension();
				$file->move(public_path('assets/img/bukti-tf'), $fileName);
				$path = asset('assets/img/bukti-tf/' . $fileName);
			}
			BookingPayment::create([
				'wahana_booking_id' => $request->get('booking_id'),
				'bukti_transfer' => $path
			]);

			return redirect()->back()->with('success', 'Bukti Pembayaran sudah diunggah');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', 'Kesalahan saat menyimpan data');
		}
	}

	public function create()
	{
	}

	public function show(BookingPayment $bookingPayment)
	{
	}

	public function edit(BookingPayment $bookingPayment)
	{
	}

	public function update(Request $request, BookingPayment $bookingPayment)
	{
	}

	public function destroy(BookingPayment $bookingPayment)
	{
	}
}
