<?php

namespace App\Filament\Resources\SubmoduleResource\Pages;

use App\Filament\Resources\SubmoduleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmodules extends ListRecords
{
    protected static string $resource = SubmoduleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
