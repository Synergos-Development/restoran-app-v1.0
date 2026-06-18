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
}