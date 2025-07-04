<?php

namespace App\Filament\Resources\AssessmentResource\Pages;

use App\Filament\Resources\AssessmentResource;
use App\Models\Assessment;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessment extends EditRecord
{
    protected static string $resource = AssessmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('Rekap')->url(fn () => route('dapur.espresso', $this->record->id)),
            Actions\DeleteAction::make(),
        ];
    }
}
