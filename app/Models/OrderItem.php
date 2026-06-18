<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    protected static function booted(): void
    {
        static::saved(function (OrderItem $item): void {
            $item->recalculateOrderTotal();
        });

        static::deleted(function (OrderItem $item): void {
            $item->recalculateOrderTotal();
        });
    }

    protected function recalculateOrderTotal(): void
    {
        if (! $this->order_id) {
            return;
        }

        $total = static::query()
            ->where('order_id', $this->order_id)
            ->sum('subtotal');

        Order::query()
            ->whereKey($this->order_id)
            ->update(['total_price' => $total]);
    }
}
