<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = User::count();
        $todayOrder = Booking::where('created_at', now())->count();
        $thisMonth  = Booking::where('created_at', now()->month)->count();
        $allTime    = Booking::count();
        return view('home', compact('user', 'todayOrder', 'allTime', 'thisMonth'));
    }
}
