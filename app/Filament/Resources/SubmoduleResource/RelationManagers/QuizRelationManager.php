<?php

namespace App\Filament\Resources\SubmoduleResource\RelationManagers;

use App\Models\Quiz;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class QuizRelationManager extends RelationManager
{
    protected static string $relationship = 'quiz';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('is_active')->required()->inline(false)->default(true),
                    Forms\Components\TextInput::make('timer_in_minutes')
                        ->required()
                        ->numeric()
                        ->minValue(1),
                    Forms\Components\Textarea::make('description')->label('Instruction'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn (Quiz $record): string => route('filament.resources.quizzes.edit', $record)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
