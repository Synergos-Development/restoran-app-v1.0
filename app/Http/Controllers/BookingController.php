<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'customer_phone' => 'required|string|max:50',
            'booking_date' => 'required|date',
            'guest_count' => 'required|integer|min:1',
        ]);

        $data['customer_name'] = auth()->user()->name;
        $data['status'] = 'pending';

        try {
            DB::transaction(function () use ($data) {
                // Lock the table row to prevent concurrent reservations
                $table = RestaurantTable::where('id', $data['table_id'])->lockForUpdate()->first();

                if (! $table || $table->status !== 'available') {
                    throw new \Exception('Meja yang dipilih tidak tersedia. Silakan pilih meja lain.');
                }

                // Check for conflicting bookings at the same datetime
                $conflict = Booking::where('table_id', $table->id)
                    ->where('booking_date', $data['booking_date'])
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->exists();

                if ($conflict) {
                    throw new \Exception('Meja telah dipesan untuk waktu tersebut. Silakan pilih waktu atau meja lain.');
                }

                // Safe to create booking
                Booking::create($data);
            }, 5);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['booking' => $e->getMessage()])->withInput();
        }

        return redirect()->route('booking.create')->with('success', 'Booking berhasil dibuat.');
    }
}
