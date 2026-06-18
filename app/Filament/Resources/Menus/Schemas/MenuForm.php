<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('name')
                    ->label('Nama Menu')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                FileUpload::make('image')
                    ->label('Foto Menu')
                    ->image()
                    ->disk('public') // save uploads to storage/app/public so they're web-accessible via /storage
                    ->directory('menus')
                    ->imageEditor()
                    ->maxSize(2048) // 2048 KB = 2MB
                    ->imagePreviewHeight(200),

                Toggle::make('is_available')
                    ->label('Tersedia')
                    ->default(true),
            ]);

    }
}
