<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Brand Created';
    }
}
