<?php

namespace App\Filament\School\Resources\EventResource\Pages;

use App\Filament\School\Resources\EventResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Event updated')
            ->body('The event has been updated successfully.');
    }
}
