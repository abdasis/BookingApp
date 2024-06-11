<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Fasilitas::orderBy('id', 'desc')->get();
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
        return view('Fasilitas.index');
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
        $type = Fasilitas::create($request->all());
        return response()->json(['message' => 'Data Behasil Disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fasilitas = Fasilitas::find($id);
        if (!$fasilitas) {
            return response()->json(['message' => 'Fasilitas tidak ditemukan'], 404);
        }
        return response()->json($fasilitas);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::find($id);
        if (!$fasilitas) {
            return response()->json(['message' => 'fasilitas tidak ditemukan'], 404);
        }
        $fasilitas->nama = $request->nama;
        $fasilitas->save();


        return response()->json(['message' => 'Data Fasilitas berhasil diperbarui', 'room' => $fasilitas]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::find($id);
        if ($fasilitas) {
            $fasilitas->delete();
            return response()->json(['message' => 'fasilitas berhasil dihapus'], 200);
        } else {
            return response()->json(['message' => 'room tidak ditemukan'], 404);
        }
    }
}
