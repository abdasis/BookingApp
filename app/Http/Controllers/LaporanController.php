<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('laporan.index');
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('checkIn');
        $endDate = $request->input('checkOut');
        $dataLaporan = Booking::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();
        return response()->json($dataLaporan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cetakLaporan(Request $request)
    {
        $startDate = $request->input('checkIn');
        $endDate = $request->input('checkOut');
        $dataLaporan = Booking::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with(['roomtypes', 'user'])
            ->get();

        $data = [
            'title' => 'Laporan Booking',
            'date' => date('m/d/Y'),
            'booking' => $dataLaporan
        ];
        // dd($data);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('laporan.cetakLaporan', $data);
        return $pdf->download('Laporan Booking - ' . date('d-m-Y') . '.pdf');
    }

    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
