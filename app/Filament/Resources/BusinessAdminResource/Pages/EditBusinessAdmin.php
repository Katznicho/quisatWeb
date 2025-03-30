<?php

namespace App\Filament\Resources\BusinessAdminResource\Pages;

use App\Filament\Resources\BusinessAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessAdmin extends EditRecord
{
    protected static string $resource = BusinessAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
