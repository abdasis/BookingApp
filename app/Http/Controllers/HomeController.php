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
    public function index(): View
    {
        $user = User::count();
        $todayOrder = Booking::where('created_at',now())->count();
        $thisMonth  = Booking::where('created_at', now()->month)->count();
        $allTime    = Booking::count();
        return view('home', compact('user','todayOrder','allTime','thisMonth'));
    }
}
