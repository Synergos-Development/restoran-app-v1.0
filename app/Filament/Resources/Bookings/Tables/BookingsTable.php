<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('table.table_number')
                    ->label('Meja')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_name')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_phone')
                    ->label('Nomor HP')
                    ->searchable(),

                TextColumn::make('booking_date')
                    ->label('Tanggal Booking')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                TextColumn::make('guest_count')
                    ->label('Jumlah Tamu')
                    ->suffix(' Orang')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([]);
    }
}