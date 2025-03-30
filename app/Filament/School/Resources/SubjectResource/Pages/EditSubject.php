<?php

namespace App\Filament\School\Resources\SubjectResource\Pages;

use App\Filament\School\Resources\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubject extends EditRecord
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
