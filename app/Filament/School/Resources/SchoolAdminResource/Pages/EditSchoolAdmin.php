<?php

namespace App\Filament\School\Resources\SchoolAdminResource\Pages;

use App\Filament\School\Resources\SchoolAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolAdmin extends EditRecord
{
    protected static string $resource = SchoolAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
