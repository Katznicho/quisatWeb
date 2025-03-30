<?php

namespace App\Filament\School\Resources\SchoolAdminResource\Pages;

use App\Filament\School\Resources\SchoolAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolAdmins extends ListRecords
{
    protected static string $resource = SchoolAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
