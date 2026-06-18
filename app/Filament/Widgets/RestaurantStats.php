<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RestaurantStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();

        if ($user?->hasRole('Admin')) {
            return $this->getAdminStats();
        }

        if ($user?->hasRole('Kasir')) {
            return $this->getKasirStats();
        }

        return [];
    }

    protected function getAdminStats(): array
    {
        $revenueToday = Payment::query()
            ->where('status', 'paid')
            ->whereDate('paid_at', today())
            ->sum('amount');

        $revenueThisMonth = Payment::query()
            ->where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        return [
            Stat::make('Total Bookings', Booking::count())
                ->description('Semua booking')
                ->icon('heroicon-o-calendar-days')
                ->color('primary'),

            Stat::make('Total Orders', Order::count())
                ->description('Semua pesanan')
                ->icon('heroicon-o-shopping-cart')
                ->color('success'),

            Stat::make('Total Payments', Payment::count())
                ->description('Semua pembayaran')
                ->icon('heroicon-o-banknotes')
                ->color('warning'),

            Stat::make('Revenue Today', 'Rp '.number_format($revenueToday, 0, ',', '.'))
                ->description('Pendapatan hari ini')
                ->icon('heroicon-o-currency-dollar')
                ->color('success'),

            Stat::make('Revenue This Month', 'Rp '.number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Pendapatan bulan ini')
                ->icon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }

    protected function getKasirStats(): array
    {
        return [
            Stat::make("Today's Orders", Order::whereDate('created_at', today())->count())
                ->description('Pesanan hari ini')
                ->icon('heroicon-o-shopping-cart')
                ->color('success'),

            Stat::make("Today's Bookings", Booking::whereDate('created_at', today())->count())
                ->description('Booking hari ini')
                ->icon('heroicon-o-calendar-days')
                ->color('primary'),

            Stat::make("Today's Payments", Payment::whereDate('created_at', today())->count())
                ->description('Pembayaran hari ini')
                ->icon('heroicon-o-banknotes')
                ->color('warning'),
        ];
    }
}
