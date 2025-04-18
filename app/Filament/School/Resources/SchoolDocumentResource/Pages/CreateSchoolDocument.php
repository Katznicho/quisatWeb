<?php

namespace App\Filament\School\Resources\SchoolDocumentResource\Pages;

use App\Filament\School\Resources\SchoolDocumentResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSchoolDocument extends CreateRecord
{
    protected static string $resource = SchoolDocumentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Document uploaded')
            ->body('The document has been uploaded successfully.');
    }
}
