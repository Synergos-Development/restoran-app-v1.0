<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->label('Order')
                    ->relationship('order', 'order_number')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Cash',
                        'qris' => 'QRIS',
                        'card' => 'Kartu',
                    ])
                    ->required(),

                TextInput::make('amount')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required(),

                DateTimePicker::make('paid_at')
                    ->label('Tanggal Pembayaran')
                    ->seconds(false),
            ]);

    }
}
