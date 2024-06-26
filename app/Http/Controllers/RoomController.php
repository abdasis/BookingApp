<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-md btn-edit" title="Edit"><i class="fas fa-edit"></i></a>';
                    $btnDelete = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-md btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
                    return $btnEdit . ' ' . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $type = Roomtype::orderBy('id','desc')->get();
        return view('Master-Room.index',compact('type'));

    }
    public function roomtype(Request $request)
    {
        if ($request->ajax()) {
            $data = Roomtype::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-md btn-edit" title="Edit"><i class="fas fa-edit"></i></a>';
                    $btnDelete = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-md btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></a>';
                    return $btnEdit . ' ' . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Master-Room.room-type');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function getroom(Request $request)
    {
    $checkinDate = $request->checkIn;
    $checkoutDate = $request->checkOut;
        // $checkinDate ='2024-8-2';
        // $checkoutDate = '2024-8-2';

    $kamarkosong = DB::table('rooms')
        ->leftJoin('bookings', function ($join) use ($checkinDate, $checkoutDate) {
            $join->on('rooms.id', '=', 'bookings.roomId')
                ->where(function ($query) use ($checkinDate, $checkoutDate) {
                    $query->where(function ($query) use ($checkinDate, $checkoutDate) {
                        $query->where('bookings.checkIn', '<=', $checkoutDate)
                            ->where('bookings.checkOut', '>=', $checkinDate);
                    });
                });
        })
        ->leftJoin('roomtypes', 'rooms.roomtype', '=', 'roomtypes.id')
        ->whereNull('bookings.id')
        ->select('rooms.id', 'roomtypes.nama as tiperoom', 'rooms.nama', 'rooms.deskripsi', 'rooms.qty', 'rooms.tarifWd', 'rooms.tarifWe', 'rooms.Fasilitas', 'rooms.status')
        ->get();

    for ($i=0; $i < count($kamarkosong); $i++) {
            $kamarkosong[$i]->Fasilitas = json_decode($kamarkosong[$i]->Fasilitas);
    }

    return response()->json($kamarkosong);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = Room::create($request->all());
        return response()->json(['message' => 'Data Behasil Disimpan'], 200);
    }
    public function addType(Request $request)
    {
        $type = Roomtype::create($request->all());
        return response()->json(['message' => 'Data Behasil Disimpan'], 200);
    }
    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
dd("qweqwe");
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
        dd("qweqwe");
        $type = Room::find($id);
        if (!$type) {
            return response()->json(['message' => 'room tidak ditemukan'], 404);
        }
        $type->nama = $request->nama;
        $type->qty = $request->qty;
        $type->checkout = $request->checkout;
        $type->save();


        return response()->json(['message' => 'Data room berhasil diperbarui', 'type' => $type]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        if ($room) {
            $room->delete();
            return response()->json(['message' => 'room berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'room tidak ditemukan'], 404);
        }
    }
    public function destroyType($id)
    {
        $type = Roomtype::find($id);
        if ($type) {
            $type->delete();
            return response()->json(['message' => 'type berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'type tidak ditemukan'], 404);
        }
    }
}

