<?php

namespace App\Filament\Resources\DesaUserResource\Pages;

use App\Filament\Resources\DesaUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesaUser extends EditRecord
{
    protected static string $resource = DesaUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
