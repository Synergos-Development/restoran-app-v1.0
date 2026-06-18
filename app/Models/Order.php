<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'booking_id',
        'order_number',
        'status',
        'total_price',
    ];

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($order) {

            $lastId = static::max('id') + 1;

            $order->order_number =
                'ORD-'.now()->format('Ymd').'-'.str_pad($lastId, 4, '0', STR_PAD_LEFT);
        });
    }
}
