<?php

namespace App\Filament\School\Resources\EventResource\Pages;

use App\Filament\School\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Event created')
            ->body('The event has been created successfully.');
    }
}
