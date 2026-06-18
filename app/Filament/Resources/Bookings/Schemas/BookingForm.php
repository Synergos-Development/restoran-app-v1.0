<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Placeholder;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('table_id')
                    ->relationship(
                        name: 'table',
                        titleAttribute: 'table_number',
                        modifyQueryUsing: fn ($query) => $query->where('status', 'available')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->visible(fn (string $operation) => $operation === 'create'),

                Placeholder::make('table_number')
                    ->label('Meja')
                    ->content(fn ($record) => $record?->table?->table_number)
                    ->visible(fn (string $operation) => $operation === 'edit'),

                TextInput::make('customer_name')
                    ->label('Nama Customer')
                    ->required()
                    ->maxLength(255),

                TextInput::make('customer_phone')
                    ->label('Nomor HP')
                    ->tel()
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(20),

                DateTimePicker::make('booking_date')
                    ->label('Tanggal Booking')
                    ->seconds(false)
                    ->disabledOn('edit')
                    ->required(),

                TextInput::make('guest_count')
                    ->label('Jumlah Tamu')
                    ->numeric()
                    ->minValue(1)
                    ->disabledOn('edit')
                    ->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
