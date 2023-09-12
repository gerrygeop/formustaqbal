<?php

namespace App\Filament\Resources\LocalResource\Pages;

use App\Filament\Resources\LocalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLocals extends ManageRecords
{
    protected static string $resource = LocalResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
