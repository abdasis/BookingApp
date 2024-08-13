<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    if (Auth()->user()->role == "Pengunjung") {
        return view('user');
    } else {
        // Menghitung jumlah pengguna
        $user = User::count();

        // Menghitung jumlah pemesanan hari ini
        $today = now()->startOfDay();
        $todayOrder = Booking::whereDate('created_at', $today)->count();

        // Menghitung jumlah pemesanan bulan ini
        $startOfMonth = now()->startOfMonth();
        $thisMonth = Booking::whereDate('created_at', '>=', $startOfMonth)->count();

        // Menghitung jumlah pemesanan secara keseluruhan
        $allTime = Booking::count();

        return view('home', compact('user', 'todayOrder', 'allTime', 'thisMonth'));
    }
}

}
