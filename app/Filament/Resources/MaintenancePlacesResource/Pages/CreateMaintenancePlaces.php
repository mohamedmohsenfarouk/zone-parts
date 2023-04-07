<?php

namespace App\Filament\Resources\MaintenancePlacesResource\Pages;

use App\Filament\Resources\MaintenancePlacesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaintenancePlaces extends CreateRecord
{
    protected static string $resource = MaintenancePlacesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Maintenance Places Created';
    }
}
