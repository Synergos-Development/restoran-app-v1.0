<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Booking;
use App\Models\Menu;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Meja')
                    ->schema([
                        Select::make('table_id')
                            ->label('Meja')
                            ->relationship('table', 'table_number')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(1),

                        Select::make('booking_id')
                            ->label('Booking (Opsional)')
                            ->relationship(
                                name: 'booking',
                                titleAttribute: 'customer_name',
                                modifyQueryUsing: fn ($query) => $query->whereIn('status', ['pending', 'confirmed'])
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set): void {
                                if (! $state) {
                                    return;
                                }

                                $booking = Booking::find($state);

                                if ($booking?->table_id) {
                                    $set('table_id', $booking->table_id);
                                }
                            })
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Item Pesanan')
                    ->schema([
                        Repeater::make('orderItems')
                            ->relationship()
                            ->label('')
                            ->schema([
                                Select::make('menu_id')
                                    ->label('Menu')
                                    ->relationship('menu', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $menu = Menu::find($state);
                                        $price = $menu?->price ?? 0;

                                        $set('unit_price', $price);
                                        $set('subtotal', $price * ((int) ($get('quantity') ?: 1)));
                                        self::syncOrderTotal($get, $set);
                                    })
                                    ->required()
                                    ->columnSpan(2),

                                TextInput::make('quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->live()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $set(
                                            'subtotal',
                                            ((float) ($get('unit_price') ?? 0)) * ((int) ($state ?? 0))
                                        );
                                        self::syncOrderTotal($get, $set);
                                    })
                                    ->required()
                                    ->columnSpan(1),

                                TextInput::make('unit_price')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->readOnly()
                                    ->dehydrated()
                                    ->prefix('Rp')
                                    ->columnSpan(1),

                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->readOnly()
                                    ->dehydrated()
                                    ->prefix('Rp')
                                    ->columnSpan(1),
                            ])
                            ->columns(5)
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Item')
                            ->reorderable(false)
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::syncOrderTotal($get, $set);
                            }),
                    ]),

                Section::make('Ringkasan')
                    ->schema([
                        Placeholder::make('total_display')
                            ->label('Total Pembayaran')
                            ->content(function (Get $get): string {
                                $total = self::calculateTotalFromItems($get('orderItems'));

                                return 'Rp '.number_format($total, 0, ',', '.');
                            })
                            ->extraAttributes([
                                'class' => 'text-2xl font-bold text-primary-600',
                            ]),

                        TextInput::make('total_price')
                            ->label('Total')
                            ->numeric()
                            ->readOnly()
                            ->dehydrated()
                            ->default(0)
                            ->hidden(),
                    ]),
            ]);
    }

    public static function calculateTotalFromItems(?array $items): float
    {
        return (float) collect($items ?? [])->sum(function ($item) {
            if (isset($item['subtotal']) && $item['subtotal'] !== '') {
                return (float) $item['subtotal'];
            }

            return ((float) ($item['unit_price'] ?? 0)) * ((int) ($item['quantity'] ?? 0));
        });
    }

    protected static function syncOrderTotal(Get $get, Set $set): void
    {
        $set('total_price', self::calculateTotalFromItems($get('orderItems')));
    }
}
