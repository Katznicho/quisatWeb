<?php

namespace App\Filament\Resources\ProgramEventResource\Pages;

use App\Filament\Resources\ProgramEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgramEvent extends EditRecord
{
    protected static string $resource = ProgramEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
