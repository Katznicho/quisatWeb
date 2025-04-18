<?php

namespace App\Filament\School\Resources\GuardianResource\Pages;

use App\Filament\School\Resources\GuardianResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateGuardian extends CreateRecord
{
    protected static string $resource = GuardianResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Guardian created')
            ->body('The guardian has been created successfully.');
    }
}
