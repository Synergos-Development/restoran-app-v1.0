<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function create()
    {
        $tables = RestaurantTable::where('status', 'available')->get();
        return view('booking.create', compact('tables'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'booking_date' => 'required|date',
            'guest_count' => 'required|integer|min:1',
        ]);

        $data['status'] = 'pending';

        try {
            Booking::create($data);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error' => $e->getMessage()])->withInput();
        }

        return redirect()->route('booking.create')->with('success', 'Booking berhasil dibuat.');
    }
}
