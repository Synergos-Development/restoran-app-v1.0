<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Models\Menu;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('menu_id')
                    ->label('Menu')
                    ->relationship('menu', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {

                        $menu = Menu::find($state);

                        $price = $menu?->price ?? 0;

                        $set('unit_price', $price);

                        $set(
                            'subtotal',
                            $price * ($get('quantity') ?: 1)
                        );
                    })
                    ->required(),

                TextInput::make('quantity')
                    ->label('Qty')
                    ->numeric()
                    ->default(1)
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {

                        $set(
                            'subtotal',
                            ($get('unit_price') ?? 0) * ($state ?? 0)
                        );
                    })
                    ->required(),

                TextInput::make('unit_price')
                    ->label('Harga')
                    ->numeric()
                    ->readOnly(),
                    
                TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->readOnly(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('menu.name')
                    ->label('Menu'),

                TextColumn::make('quantity')
                    ->label('Qty'),

                TextColumn::make('unit_price')
                    ->money('IDR')
                    ->label('Harga'),

                TextColumn::make('subtotal')
                    ->money('IDR')
                    ->label('Subtotal'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
