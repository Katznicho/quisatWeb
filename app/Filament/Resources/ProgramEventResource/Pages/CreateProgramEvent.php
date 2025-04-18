<?php

namespace App\Filament\Resources\ProgramEventResource\Pages;

use App\Filament\Resources\ProgramEventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProgramEvent extends CreateRecord
{
    protected static string $resource = ProgramEventResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
