<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (Schema::hasColumn('bookings', 'user_id')) {
            $bookings = Booking::where('user_id', $user->id)->get();
        } elseif (Schema::hasColumn('bookings', 'customer_email')) {
            $bookings = Booking::where('customer_email', $user->email)->get();
        } else {
            $bookings = Booking::where('customer_name', $user->name)->get();
        }

        return view('customer.dashboard', compact('bookings'));
    }
}
