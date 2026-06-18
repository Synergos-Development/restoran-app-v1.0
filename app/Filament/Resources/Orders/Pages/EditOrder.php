<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Orders\Schemas\OrderForm;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected static ?string $title = 'Edit Pesanan';

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['total_price'] = OrderForm::calculateTotalFromItems($data['orderItems'] ?? []);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->visible(fn () => auth()->user()?->hasRole('Admin') ?? false),
        ];
    }

    protected function getSaveFormActionLabel(): string
    {
        return 'Update Pesanan';
    }
}
