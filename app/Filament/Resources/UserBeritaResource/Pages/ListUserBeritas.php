<?php

namespace App\Filament\Resources\UserBeritaResource\Pages;

use App\Filament\Resources\UserBeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserBeritas extends ListRecords
{
    protected static string $resource = UserBeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
