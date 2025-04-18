<?php

namespace App\Filament\School\Resources\GuardianResource\Pages;

use App\Filament\School\Resources\GuardianResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditGuardian extends EditRecord
{
    protected static string $resource = GuardianResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Guardian updated')
            ->body('The guardian has been updated successfully.');
    }
}
