<?php

namespace App\Filament\Resources\OffersPricesResource\Pages;

use App\Filament\Resources\OffersPricesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOffersPrices extends CreateRecord
{
    protected static string $resource = OffersPricesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Offer Prices Created';
    }
}
