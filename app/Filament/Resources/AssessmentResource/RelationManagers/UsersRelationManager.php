<?php

namespace App\Filament\Resources\AssessmentResource\RelationManagers;

use App\Models\Question;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Repeater::make('answers')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('question_id')
                                    ->relationship('questions', 'question')
                                    ->disabled(),
                                Forms\Components\Select::make('choice')
                                    ->relationship('choice', 'choice')
                                    ->disabled()
                                    ->hidden(function ($state) {
                                        return $state == NULL ? true : false;
                                    }),
                                Forms\Components\TextInput::make('answer_text')
                                    ->label('Answer')
                                    ->disabled()
                                    ->hidden(function ($state) {
                                        return $state == NULL ? true : false;
                                    }),

                                Forms\Components\TextInput::make('point')->required()->numeric()->default(0)->minValue(0),
                            ])
                            ->disableItemCreation()
                            ->disableItemDeletion()
                            ->disableItemMovement(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
