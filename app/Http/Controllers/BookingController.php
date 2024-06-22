<?php

namespace App\Http\Controllers;

use App\Mail\BookingStatusMail;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Roomtype;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $type = Roomtype::all();
        Return view("Booking.index",compact('type'));
    }

    public function listBooking(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $gambar = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-primary btn-sm btn-bukti" >Bukti TF</a>';
                    return $gambar;
                })
                ->addColumn('Kontak', function ($row) {
                    $Kontak = $row->Email . '<br>' . $row->hp;
                    return $Kontak;
                })
                ->addColumn('StatusBooking', function ($row) {
                    if($row->Status == 0){
                        $StatusBooking = '<span class="badge bg-success text-white">Menunggu Pembayaran</span>';
                    }elseif($row->Status == 1){
                        $StatusBooking = '<span class="badge bg-success text-white">Dibayar</span>';
                    }else if($row->Status == 2){
                        $StatusBooking = '<span class="badge bg-warning text-white">Belum Dikonfirmasi</span>';
                    }else{
                        $StatusBooking = '<span class="badge bg-danger text-white">Cancel Order</span>';
                    }

                    return $StatusBooking;

                })
                ->addColumn('Online', function ($row) {
                    if($row->isOnline == 0){
                        $Online = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#ff000d"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 1 0 0 1 1.32 -1.497z" /></svg>';
                    }else{
                        $Online = '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#009e12"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.333 2c1.96 0 3.56 1.537 3.662 3.472l.005 .195v12.666c0 1.96 -1.537 3.56 -3.472 3.662l-.195 .005h-12.666a3.667 3.667 0 0 1 -3.662 -3.472l-.005 -.195v-12.666c0 -1.96 1.537 -3.56 3.472 -3.662l.195 -.005h12.666zm-2.626 7.293a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg>';
                    }
                    return $Online;
                })
                ->addColumn('Jk', function ($row) {
                    if($row->Gender == "P"){
                        $Jk = 'Pria';
                    }else{
                        $Jk = 'Wanita';
                    }
                    return $Jk;
                })
                ->rawColumns(['action', 'Kontak','StatusBooking','Online','Jk'])
                ->make(true);
        }
        return view('Booking.list-booking');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $getData = Room::with('roomtypes')->where('id', $id)->first();
        // dd($getData);
        $today = Carbon::today();
        $isWeekend = $today->isSaturday() || $today->isSunday();
        return view('Booking.create',compact('getData','isWeekend'));
    }
    public function BookingOnline($id)
    {
        $getData = Room::with('roomtypes')->where('id', $id)->first();
        // dd($getData);
        $today = Carbon::today();
        $isWeekend = $today->isSaturday() || $today->isSunday();
        return view('Client.create',compact('getData','isWeekend'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($generatePassword);
        $tarifTotal = str_replace('Rp. ', '', $request->tarifTotal);
        $tarifTotal = str_replace('.', '', $tarifTotal);

        $data = $request->all();
        $data['Total'] = $tarifTotal;
        $data['Status'] = "1"; //0 = Menggungu Pembayaran, 1=Dibayar, 2=Menunggu Konfirmasi, 3=cancer Order
        $data['isOnline'] = "0"; //0 = Offline Booking, 1 = Online Booking
        $data = Booking::create($data);

        //update status room
        $query = Room::find($request->roomId);
        $data1['status'] = "1"; //0 = Available, 1=Booked
        $query->update($data1);

        //create user

        $generatePassword = now()->format('dmY');
        $input['name'] = $request->NamaBooking;
        $input['email'] = $request->Email;
        $input['password'] = Hash::make($generatePassword);
        $input['role'] = 'Pengujung';

        $user = User::create($input);
        $user->assignRole('2');

        Mail::to($request->Email)->send(new BookingStatusMail($data));

        return response()->json($data);
    }
    public function onlinestore(Request $request)
    {
        // dd($generatePassword);
        $tarifTotal = str_replace('Rp. ', '', $request->tarifTotal);
        $tarifTotal = str_replace('.', '', $tarifTotal);

        $data2 = $request->all();
        $data2['Total'] = $tarifTotal;
        $data2['Status'] = "0"; //0 = Menggungu Pembayaran, 1=Dibayar, 2=Menunggu Konfirmasi, 3=cancer Order
        $data2['isOnline'] = "1"; //0 = Offline Booking, 1 = Online Booking
        $data = Booking::create($data2);

        //update status room
        $query = Room::find($request->roomId);
        $data1['status'] = "1"; //0 = Available, 1=Booked
        $query->update($data1);

        //create user

        $generatePassword = now()->format('dmY');
        $input['name'] = $request->NamaBooking;
        $input['email'] = $request->Email;
        $input['password'] = Hash::make($generatePassword);
        $input['role'] = 'Pengujung';

        $user = User::create($input);
        $user->assignRole('2');

        $dataEmail = [
            'user' => $input,
            'password' => $generatePassword,
            'booking' => $data2
        ];
        // dd($dataEmail);
        Mail::to($request->Email)->send(new BookingStatusMail($dataEmail));

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = Booking::with('roomtypes')->where('userId',auth()->user()->id)->latest()->first();
        $history = Booking::with('roomtypes')->where('userId', auth()->user()->id)->where('Status', '1')->get();
        // dd($data);
        return view('client.pa  yment',compact('data','history'));
    }
public function getBukti($id){
        $buktitf = Booking::find($id);
        if (!$buktitf) {
            return response()->json(['message' => 'Lencana tidak ditemukan'], 404);
        }
        return response()->json($buktitf);
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'booking tidak ditemukan'], 404);
        }
        $gambar = $request->file('file');
        $gambar->storeAs('public/booking', $gambar->getClientOriginalName());

        $booking->Status = '2';
        $booking->buktiBayar = $gambar->getClientOriginalName();
        $booking->save();

        return response()->json(['message' => 'Data Booking berhasil diperbarui', 'room' => $booking]);
    }
    public function konfirmasi(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'booking tidak ditemukan'], 404);
        }
        $booking->Status = '1';
        $booking->save();

        return response()->json(['message' => 'Data Booking berhasil diperbarui', 'room' => $booking]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
