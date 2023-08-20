<?php

namespace App\Filament\Resources\TestResource\RelationManagers;

use App\Models\Answer;
use App\Models\Question;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'answers';

    protected static ?string $recordTitleAttribute = 'user_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user')->relationship('user', 'name')->required(),
                        Forms\Components\Repeater::make('answer')
                            ->schema([
                                Forms\Components\TextInput::make('response'),
                                Forms\Components\Select::make('question_id')
                                    ->label('Question')
                                    ->options(Question::all()->pluck('question')),
                                Forms\Components\TextInput::make('question_type')
                            ])
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->disableItemMovement()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Review')->url(fn (Answer $record): string => route('filament.resources.answers.edit', $record)),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
