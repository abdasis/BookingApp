<?php

namespace App\Http\Controllers;

use App\Http\Requests\WahanaRequest;
use App\Mail\BookingStatusMail;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Wahana;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Request;
use Yajra\DataTables\DataTables;

class WahanaController extends Controller
{
	public function index()
	{
		return view('wahana.index');
	}

	public function store(WahanaRequest $request)
	{
		try {
			if ($request->hasFile('galeries')) {
				$fileNames = [];
				foreach ($request->file('galeries') as $key => $file) {
					$fileName = time().$key.'.'.$file->extension();
					$file->move(public_path('assets/img/wahana'), $fileName);
					$fileNames[] = $fileName;
				}
				$request->merge([
					'galeries' => $fileNames
				]);
			}

			Wahana::create([
				'nama' => $request->input('nama'),
				'deskripsi' => $request->input('deskripsi'),
				'harga_weekday' => $request->input('harga_weekday'),
				'harga_weekend' => $request->input('harga_weekend'),
				'galeries' => json_encode($request->input('galeries')),
			]);
			return redirect()->route('wahana.index')->with('success', 'Data Berhasil Ditambahkan');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', 'Kesalahan saat menyimpan data');
		}
	}

	public function create()
	{
		return view('wahana.create');
	}

	public function show(Wahana $wahana)
	{
	}

	public function edit(Wahana $wahana)
	{
		return view('wahana.edit', compact('wahana'));
	}

	public function update(WahanaRequest $request, Wahana $wahana)
	{
		try {
			if ($request->hasFile('galeries')) {
				$fileNames = [];
				foreach ($request->file('galeries') as $key => $file) {
					$fileName = time().$key.'.'.$file->extension();
					$file->move(public_path('assets/img/wahana'), $fileName);
					$fileNames[] = $fileName;
				}
				$request->merge([
					'galeries' => $fileNames
				]);
			}

			Wahana::where('id', $wahana->id)->update([
				'nama' => $request->input('nama'),
				'deskripsi' => $request->input('deskripsi'),
				'harga_weekday' => $request->input('harga_weekday'),
				'harga_weekend' => $request->input('harga_weekend'),
				'galeries' => json_encode($request->input('galeries')),
			]);
			return redirect()->route('wahana.index')->with('success', 'Data Berhasil Diperbarui');
		} catch (Exception $exception) {
			return redirect()->back()->with('error', 'Kesalahan saat menyimpan data');
		}
	}

	public function destroy(Wahana $wahana)
	{
		try {
			$wahana->delete();
			return redirect()->route('wahana.index')->with('success', 'Data Berhasil Dihapus');
		} catch (Exception $exception) {
			report($exception);
			return redirect()->back()->with('error', 'Kesalahan saat menghapus data');
		}
	}

	public function daftarWahana()
	{
		$data_wahana = Wahana::all();
		return view('wahana.daftar-wahana', compact('data_wahana'));
	}

	public function all(DataTables $dataTables)
	{
		$query = Wahana::query();
		return $dataTables->eloquent($query)
			->addColumn('action', function (Wahana $wahana) {
				$editUrl = route('wahana.edit', $wahana);
				$deleteUrl = route('wahana.destroy', $wahana);
				return view('partials.wahana-actions', compact('editUrl', 'deleteUrl'));
			})
			->make(true);
	}

	public function booking($id)
	{
		$wahana = Wahana::find($id);
		return view('wahana.booking', compact('wahana'));
	}

	public function storeBooking(Request $request)
	{




	}
}
