<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;
use Exception;
use Yajra\DataTables\DataTables;

class VoucherController extends Controller
{
	public function index()
	{
		return view('vouchers.index');
	}

	public function store(VoucherRequest $request)
	{
		try {
			app(VoucherRepositoryInterface::class)->create($request->all());
			return redirect()->route('vouchers.index')->with('success', 'Voucher Berhasil Ditambahkan');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', $exception->getMessage());
		}
	}

	public function create()
	{
		return view('vouchers.create');
	}

	public function all(DataTables $datatables)
	{
		$query = Voucher::query();
		return $datatables->eloquent($query)
			->addColumn('action', function (Voucher $voucher) {
				$editUrl = route('voucher.edit', $voucher);
				$deleteUrl = route('voucher.destroy', $voucher);
				return view('partials.voucher-actions', compact('editUrl', 'deleteUrl'));
			})
			->editColumn('start_date', function ($voucher) {
				return $voucher->start_date->format('d-m-Y');
			})
			->editColumn('expired_date', function ($voucher) {
				return $voucher->expired_date->format('d-m-Y');
			})
			->editColumn('description', function ($voucher) {
				return $voucher->description ?? '-';
			})
			->editColumn('amount', function ($voucher) {
				return "<div class='text-end'>Rp ".number_format($voucher->amount, 0, ',', '.')."</div>";
			})
			->editColumn('status', function ($voucher) {
				if ($voucher->status === 'active') {
					return "<div class='badge bg-success-lt badge-success'>Aktif</div></div>";
				}

				return "<div class='badge badge-danger bg-danger-lt'>Tidak Aktif</div></div>";
			})
			->rawColumns([
				'status',
				'action',
				'amount'
			])  // Tambahkan ini agar HTML dalam kolom status dan action dirender
			->make(true);
	}

	public function show(Voucher $voucher)
	{
	}

	public function edit(Voucher $voucher)
	{
		return view('vouchers.edit', compact('voucher'));
	}

	public function update(VoucherRequest $request, Voucher $voucher)
	{
		try {
			app(VoucherRepositoryInterface::class)->update($voucher->id, $request->all());
			return redirect()->route('voucher.index')->with('success', 'Voucher Berhasil Diubah');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', $exception->getMessage());
		}
	}

	public function destroy(Voucher $voucher)
	{
		try {
			app(VoucherRepositoryInterface::class)->delete($voucher->id);
			return redirect()->route('voucher.index')->with('success', 'Voucher Berhasil Dihapus');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', $exception->getMessage());
		}
	}
}
