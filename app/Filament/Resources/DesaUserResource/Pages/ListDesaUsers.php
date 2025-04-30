<?php

namespace App\Filament\Resources\DesaUserResource\Pages;

use App\Filament\Resources\DesaUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesaUsers extends ListRecords
{
    protected static string $resource = DesaUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
