<?php

namespace App\Filament\Resources\MaintenancePlacesResource\Pages;

use App\Filament\Resources\MaintenancePlacesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenancePlaces extends ListRecords
{
    protected static string $resource = MaintenancePlacesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
