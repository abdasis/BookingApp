<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Models\Roomtype;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Room::with('roomtypes')->orderBy('id', 'desc')->get();
			// dd($data);
			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$btnEdit = '<a href="javascript:void(0)" data-id="'.
					           $row->id.
					           '" class="btn btn-primary btn-md btn-edit" title="Edit"><i class="fas fa-edit"></i></a>';
					$btnDelete = '<a href="javascript:void(0)" data-id="'.
					             $row->id.
					             '" class="btn btn-danger btn-md btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
					return $btnEdit.' '.$btnDelete;
				})
				->rawColumns(['action'])
				->make(true);
		}

		$type = Roomtype::orderBy('id', 'desc')->get();
		$fasilitas = Fasilitas::get();
		return view('master-room.home', compact('type', 'fasilitas'));
	}

	public function roomtype(Request $request)
	{
		if ($request->ajax()) {
			$data = Roomtype::orderBy('id', 'desc')->get();
			return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function ($row) {
					$btnEdit = '<a href="javascript:void(0)" data-id="'.
					           $row->id.
					           '" class="btn btn-primary btn-md btn-edit" title="Edit"><i class="fas fa-edit"></i></a>';
					$btnDelete = '<a href="javascript:void(0)" data-id="'.
					             $row->id.
					             '" class="btn btn-danger btn-md btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
					return $btnEdit;
				})
				->rawColumns(['action'])
				->make(true);
		}
		return view('master-room.room-type');
	}

	public function getroom(Request $request)
	{
		$today = now();

		if (empty($request->checkIn)) {
			$checkinDate = $today;
			$checkoutDate = $today;
		} else {
			$checkinDate = $request->checkIn;
			$checkoutDate = $request->checkOut;
		}

		$kamarkosong = DB::table('rooms')
			->leftJoin('bookings', 'rooms.id', '=', 'bookings.roomId')
			// ->leftJoin('bookings', function ($join) {
			//         $join
			//             ->on('rooms.id', '=', 'bookings.roomId')
			//             ->where('rooms.deleted_at',null);
			// })
			->leftJoin('roomtypes', 'rooms.roomtype', '=', 'roomtypes.id')
			->select('rooms.id', 'roomtypes.nama as tiperoom', 'rooms.nama', 'rooms.deskripsi', 'rooms.qty', 'rooms.tarifWd', 'rooms.tarifWe', 'rooms.fasilitas', 'rooms.status', 'rooms.imgPreview', 'bookings.checkIn as bookingCheckIn', 'bookings.checkOut as bookingCheckOut')
			->orderBy('rooms.id', 'desc')
			->get();

		$processedRooms = [];
		$uniqueRooms = [];

		foreach ($kamarkosong as $room) {
			if (!in_array($room->id, $processedRooms)) {
				$room->fasilitas = json_decode($room->fasilitas);
				if (!empty($room->bookingCheckIn) && !empty($room->bookingCheckOut)) {
					if ($room->bookingCheckIn <= $checkoutDate && $room->bookingCheckOut >= $checkinDate) {
						$room->status = 'Tidak Tersedia dari '.$room->bookingCheckIn.' hingga '.$room->bookingCheckOut;
					} else {
						$room->status = 'Tersedia';
					}
				} else {
					$room->status = 'Tersedia';
				}
				$uniqueRooms[] = $room;
				$processedRooms[] = $room->id;
			}
		}

		return response()->json($uniqueRooms);
	}

	public function store(Request $request)
	{
		$data = $request->all();
		if ($request->hasFile('imgPreview')) {
			$imgPreview = $request->file('imgPreview');
			$imgPreview->storeAs('public/imgPreview', $imgPreview->getClientOriginalName());
			$imgPreview = $request->file('imgPreview');
		}
		$data['fasilitas'] = $request->layanan;
		$data['imgPreview'] = $imgPreview->getClientOriginalName();
		$room = Room::create($data);
		$roomid = Room::latest()->pluck('id')->first();
		if ($request->hasFile('gambar')) {
			$gambar = $request->file('gambar');
			// dd($roomid);
			for ($i = 0; $i < count($gambar); $i++) {
				$gambar[$i]->storeAs('public/gambar', $gambar[$i]->getClientOriginalName());
				$gambar = $request->file('gambar');
				$detail = RoomDetail::create([
					'idRoom' => $roomid,
					'gambar' => $gambar[$i]->getClientOriginalName()
				]);
			}
		}

		return response()->json(['message' => 'Data Behasil Disimpan'], 200);
	}

	public function create()
	{
		//
	}

	public function addType(Request $request)
	{
		$type = Roomtype::create($request->all());
		return response()->json(['message' => 'Data Behasil Disimpan'], 200);
	}

	public function show($id)
	{
		$room = Room::find($id);
		// dd($room);
		if (!$room) {
			return response()->json(['message' => 'Room tidak ditemukan'], 404);
		}
		return response()->json($room);
	}

	public function showType($id)
	{
		$type = Roomtype::find($id);
		if (!$type) {
			return response()->json(['message' => 'Room tidak ditemukan'], 404);
		}
		return response()->json($type);
	}

	public function edit(Room $room)
	{
		//
	}

	public function update(Request $request, $id)
	{
		$room = Room::find($id);
		if (!$room) {
			return response()->json(['message' => 'room tidak ditemukan'], 404);
		}
		$room->nama = $request->nama;
		$room->qty = $request->qty;
		$room->checkout = $request->checkout;
		$room->save();

		return response()->json(['message' => 'Data room berhasil diperbarui', 'room' => $room]);
	}

	public function updateType(Request $request, $id)
	{
		$type = Roomtype::find($id);
		if (!$type) {
			return response()->json(['message' => 'room tidak ditemukan'], 404);
		}
		$type->nama = $request->nama;
		$type->save();

		return response()->json(['message' => 'Data room berhasil diperbarui', 'type' => $type]);
	}

	public function destroy($id)
	{
		$room = Room::find($id);
		if ($room) {
			$room->delete();
			return response()->json(['message' => 'room berhasil dihapus'], 200);
		}

		return response()->json(['message' => 'room tidak ditemukan'], 404);
	}

	public function destroyType($id)
	{
		$type = Roomtype::find($id);
		if ($type) {
			$type->delete();
			return response()->json(['message' => 'type berhasil dihapus'], 200);
		}

		return response()->json(['message' => 'type tidak ditemukan'], 404);
	}
}
