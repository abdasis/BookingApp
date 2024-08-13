<?php

namespace App\Repositories;

use App\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;
use Exception;

class VoucherRepository implements VoucherRepositoryInterface
{

	public function getAll()
	{
		return Voucher::all();
	}

	public function getById($id)
	{
		return Voucher::findOrFail($id);
	}

	public function getByCode($code)
	{
		return Voucher::where('code', $code)->firstOrFail();
	}

	public function create(array $data)
	{
		try {
			return Voucher::create($data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

	public function update($id, array $data)
	{
		try {
			return Voucher::where('id', $id)->update([
				'code' => $data['code'],
				'description' => $data['description'],
				'amount' => $data['amount'],
				'status' => $data['status'],
				'expired_date' => $data['expired_date'],
				'start_date' => $data['start_date'],
			]);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

	public function delete($id)
	{
		try {
			return Voucher::where('id', $id)->delete();
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
