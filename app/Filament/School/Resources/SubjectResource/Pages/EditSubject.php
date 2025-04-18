<?php

namespace App\Filament\School\Resources\SubjectResource\Pages;

use App\Filament\School\Resources\SubjectResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditSubject extends EditRecord
{
    protected static string $resource = SubjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Subject updated')
            ->body('The subject has been updated successfully.');
    }
}
