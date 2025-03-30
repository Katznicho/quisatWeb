<?php

namespace App\Filament\Resources\BusinessAdminResource\Pages;

use App\Filament\Resources\BusinessAdminResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessAdmin extends CreateRecord
{
    protected static string $resource = BusinessAdminResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
