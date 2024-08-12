<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{

    public function index(Request $request)
    {
        $data = Whatsapp::orderBy('id', 'DESC')->paginate(5);
        return view('whatsapp.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Whatsapp::create($data);
        return redirect()->route('whatsapp.index')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function show(Whatsapp $whatsapp)
    {
        //
    }


    public function edit(Whatsapp $whatsapp)
    {
        //
    }


    public function update(Request $request, Whatsapp $whatsapp)
    {
        //
    }


    public function destroy($id)
    {
        $whatsapp = Whatsapp::find($id);
        $whatsapp->delete();
        return redirect()->route('whatsapp.index')->with('success', 'Data Berhasil Dihapus');
    }
}
