<?php

namespace App\Filament\Resources\OffersPricesResource\Pages;

use App\Filament\Resources\OffersPricesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOffersPrices extends EditRecord
{
    protected static string $resource = OffersPricesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Offer Prices updated';
    }
}
