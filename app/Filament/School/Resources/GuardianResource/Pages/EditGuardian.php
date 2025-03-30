<?php

namespace App\Filament\School\Resources\GuardianResource\Pages;

use App\Filament\School\Resources\GuardianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuardian extends EditRecord
{
    protected static string $resource = GuardianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
