<?php

namespace App\Filament\School\Resources\SchoolDocumentResource\Pages;

use App\Filament\School\Resources\SchoolDocumentResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditSchoolDocument extends EditRecord
{
    protected static string $resource = SchoolDocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Document updated')
            ->body('The document has been updated successfully.');
    }
}
