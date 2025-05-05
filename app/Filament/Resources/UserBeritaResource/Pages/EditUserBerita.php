<?php

namespace App\Filament\Resources\UserBeritaResource\Pages;

use App\Filament\Resources\UserBeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserBerita extends EditRecord
{
    protected static string $resource = UserBeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
