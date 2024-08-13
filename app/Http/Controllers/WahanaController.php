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
					'galeries' => json_encode($fileNames)
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
					'galeries' => json_encode($fileNames)
				]);
			}

			Wahana::where('id', $wahana->id)->update([
				'nama' => $request->input('nama'),
				'deskripsi' => $request->input('deskripsi'),
				'harga_weekday' => $request->input('harga_weekday'),
				'harga_weekend' => $request->input('harga_weekend'),
				'galeries' => $request->input('galeries'),
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

		$visitor_id = User::where('email', $request->Email)->first()->id;

		$booking = $request->all();
		$booking['userId'] = $visitor_id;
		$booking['Total'] = $tarifTotal;
		$booking['Status'] = '2';
		$booking['isOnline'] = '1';
		$data = Booking::create($booking);

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

	}
}
