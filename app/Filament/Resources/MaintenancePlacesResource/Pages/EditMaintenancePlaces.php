<?php

namespace App\Filament\Resources\MaintenancePlacesResource\Pages;

use App\Filament\Resources\MaintenancePlacesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaintenancePlaces extends EditRecord
{
    protected static string $resource = MaintenancePlacesResource::class;

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
        return 'Maintenance Places updated';
    }
}
