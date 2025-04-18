<?php

namespace App\Filament\School\Resources\SchoolDocumentResource\Pages;

use App\Filament\School\Resources\SchoolDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolDocuments extends ListRecords
{
    protected static string $resource = SchoolDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
