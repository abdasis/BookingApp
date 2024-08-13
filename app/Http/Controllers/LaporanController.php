<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
    $startDate = Carbon::parse($request->input('checkIn'))->startOfDay();
        $endDate = Carbon::parse($request->input('checkOut'))->endOfDay();
        $status = $request->input('status'); // Mengambil status dari request

    $query = Booking::whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);

    if (!empty($status)) {
        $query->where('status', $status);
    }

    $dataLaporan = $query->get();
    return response()->json($dataLaporan);
}


    /**
     * Show the form for creating a new resource.
     */
      public function cetakLaporan(Request $request)
    {
        $startDate = Carbon::parse($request->input('checkIn'))->startOfDay();
        $endDate = Carbon::parse($request->input('checkOut'))->endOfDay();
        $status = $request->input('status');
        // dd($status);

        $query = Booking::whereBetween('created_at', [$startDate, $endDate]);

        if ($status) {
            $query->where('Status', $status);
        }

        $dataLaporan = $query->with(['roomtypes', 'user'])->get();

        $data = [
            'title' => 'Laporan booking',
            'date' => date('m/d/Y'),
            'booking' => $dataLaporan
        ];
        $pdf = Pdf::loadView('laporan.cetakLaporan', compact('data'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_booking.pdf');
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
