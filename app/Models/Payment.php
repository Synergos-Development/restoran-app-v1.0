<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected static function booted(): void
    {
        static::updated(function (Payment $payment): void {
            if ($payment->wasChanged('status') && $payment->status === 'paid') {
                $payment->order()->update(['status' => 'completed']);
            }
        });

        static::created(function (Payment $payment): void {
            if ($payment->status === 'paid') {
                $payment->order()->update(['status' => 'completed']);
            }
        });
    }
}
