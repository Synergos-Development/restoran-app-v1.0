<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Orders\Schemas\OrderForm;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected static ?string $title = 'POS - Buat Pesanan';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'draft';
        $data['total_price'] = OrderForm::calculateTotalFromItems($data['orderItems'] ?? []);

        return $data;
    }

    protected function getCreateFormActionLabel(): string
    {
        return 'Simpan Pesanan';
    }
}
