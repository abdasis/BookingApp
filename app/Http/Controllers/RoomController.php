<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
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
        return view('Master-Room.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = Room::create($request->all());
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
        $room = room::find($id);
        if (!$room) {
            return response()->json(['message' => 'room tidak ditemukan'], 404);
        }
        $room->nama = $request->nama;
        $room->qty = $request->qty;
        $room->checkout = $request->checkout;
        $room->save();


        return response()->json(['message' => 'Data room berhasil diperbarui', 'room' => $room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = room::find($id);
        if ($room) {
            $room->delete();
            return response()->json(['message' => 'room berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'room tidak ditemukan'], 404);
        }
    }
}
