<?php

namespace App\Filament\Resources\BeritaUnggulanResource\Pages;

use App\Filament\Resources\BeritaUnggulanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeritaUnggulan extends EditRecord
{
    protected static string $resource = BeritaUnggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
