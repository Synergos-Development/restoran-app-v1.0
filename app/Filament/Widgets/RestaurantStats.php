<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RestaurantStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Menu', Menu::count()),

            Stat::make('Total Booking', Booking::count()),

            Stat::make('Total Order', Order::count()),

            Stat::make('Total Payment', Payment::count()),
        ];
    }
}
