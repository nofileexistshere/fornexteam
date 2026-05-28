<?php

namespace App\Filament\Resources\InvoiceClientResource\Pages;

use App\Filament\Resources\InvoiceClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoiceClient extends EditRecord
{
    protected static string $resource = InvoiceClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
