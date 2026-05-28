<?php

namespace App\Filament\Resources\InvoiceClientResource\Pages;

use App\Filament\Resources\InvoiceClientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoiceClient extends CreateRecord
{
    protected static string $resource = InvoiceClientResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
