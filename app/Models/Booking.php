<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'customer_name',
        'customer_phone',
        'booking_date',
        'guest_count',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Booking $booking): void {
            $exists = static::query()
                ->where('table_id', $booking->table_id)
                ->whereNotIn('status', ['completed', 'cancelled'])
                ->exists();

            if ($exists) {
                throw new \Exception('Meja sudah dibooking.');
            }
        });

        static::created(function (Booking $booking): void {
            $booking->table()->update(['status' => 'occupied']);
        });

        static::updated(function (Booking $booking): void {
            if (! $booking->wasChanged('status')) {
                return;
            }

            if (in_array($booking->status, ['completed', 'cancelled'], true)) {
                $booking->table()->update(['status' => 'available']);

                return;
            }

            $booking->table()->update(['status' => 'occupied']);
        });
    }
}
