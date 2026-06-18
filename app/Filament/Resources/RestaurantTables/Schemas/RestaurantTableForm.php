<?php

namespace App\Filament\Resources\RestaurantTables\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RestaurantTableForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('table_number')
                    ->label('Nomor Meja')
                    ->required()
                    ->maxLength(20)
                    ->unique(ignoreRecord: true),

                TextInput::make('capacity')
                    ->label('Kapasitas')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Select::make('status')
                    ->options([
                        'available' => 'Tersedia',
                        'occupied' => 'Terisi',
                    ])
                    ->default('available')
                    ->required(),
            ]);
    }
}
