<?php

namespace App\Repositories;

use App\Interfaces\BookingRepsitoryInterface;
use App\Models\WahanaBooking;
use Exception;

class BookingRepository implements BookingRepsitoryInterface
{

	public function getAll()
	{
		try {
			return WahanaBooking::all();
		} catch (Exception $e) {
			return false;
		}
	}

	public function create(array $data)
	{
		try {
			return WahanaBooking::create([
				'wahana_id' => $data['wahana_id'],
				'user_id' => $data['user_id'],
				'voucher_id' => $data['voucher_id'],
				'nomor_identitas' => $data['nomor_identitas'],
				'gender' => $data['gender'],
				'jumlah_discount' => $data['jumlah_discount'],
				'telepon' => $data['telepon'],
				'total' => $data['total'],
				'tanggal_booking' => $data['tanggal_booking'],
			]);
		} catch (Exception $e) {
			dd($e);
			return false;
		}
	}

	public function update(array $data, $id)
	{
		try {
			return WahanaBooking::findOrFail($id)->update([
				'wahana_id' => $data['wahana_id'],
				'user_id' => $data['user_id'],
				'voucher_id' => $data['voucher_id'],
				'nomor_identitas' => $data['nomor_identitas'],
				'gender' => $data['gender'],
				'jumlah_discount' => $data['jumlah_discount'],
				'telepon' => $data['telepon'],
				'total' => $data['total'],
			]);
		} catch (Exception $e) {
			return false;
		}
	}

	public function delete($id)
	{
		try {
			return WahanaBooking::findOrFail($id)->delete();
		} catch (Exception $e) {
			return false;
		}
	}

	public function getById($id)
	{
		try {
			return WahanaBooking::findOrFail($id);
		} catch (Exception $e) {
			return false;
		}
	}
}
