<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Models\Order;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Order')
                    ->schema([
                        Select::make('order_id')
                            ->label('Order')
                            ->relationship(
                                name: 'order',
                                titleAttribute: 'order_number',
                                modifyQueryUsing: fn ($query) => $query->where('status', 'draft')
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set): void {
                                if (! $state) {
                                    $set('amount', 0);

                                    return;
                                }

                                $order = Order::find($state);
                                $set('amount', $order?->total_price ?? 0);
                            })
                            ->required(),

                        Placeholder::make('order_number_display')
                            ->label('Nomor Order')
                            ->content(function (Get $get): string {
                                $order = Order::find($get('order_id'));

                                return $order?->order_number ?? '-';
                            }),

                        Placeholder::make('customer_table_display')
                            ->label('Customer / Meja')
                            ->content(function (Get $get): string {
                                $order = Order::with(['table', 'booking'])->find($get('order_id'));

                                if (! $order) {
                                    return '-';
                                }

                                if ($order->booking) {
                                    return $order->booking->customer_name.' (Meja '.$order->table?->table_number.')';
                                }

                                return 'Meja '.($order->table?->table_number ?? '-');
                            }),
                    ])
                    ->columns(2),

                Section::make('Pembayaran')
                    ->schema([
                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'cash' => 'Cash',
                                'qris' => 'QRIS',
                                'card' => 'Card',
                            ])
                            ->required()
                            ->columnSpan(1),

                        TextInput::make('amount')
                            ->label('Total Amount')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly()
                            ->dehydrated()
                            ->required()
                            ->columnSpan(1),

                        Select::make('status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->default('pending')
                            ->required()
                            ->columnSpan(1),

                        DateTimePicker::make('paid_at')
                            ->label('Tanggal Pembayaran')
                            ->seconds(false)
                            ->default(now())
                            ->columnSpan(1),
                    ])
                    ->columns(2),
            ]);
    }
}
