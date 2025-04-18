<?php

namespace App\Filament\School\Resources\SubjectResource\Pages;

use App\Filament\School\Resources\SubjectResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSubject extends CreateRecord
{
    protected static string $resource = SubjectResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Subject created')
            ->body('The subject has been created successfully.');
    }
}
