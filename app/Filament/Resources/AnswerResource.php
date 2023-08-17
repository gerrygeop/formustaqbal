<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnswerResource\Pages;
use App\Models\Answer;
use App\Models\Question;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Questions\Answers';
    protected static ?int $navigationSort = 3;
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make('answerable_type')
                        ->disabled()
                        ->dehydrated(fn ($state): string => substr($state, 12)),
                    Forms\Components\Select::make('user')->relationship('user', 'name')->disabled(),
                    Forms\Components\Repeater::make('answer')
                        ->schema([
                            Forms\Components\Select::make('question_id')
                                ->label('Question')
                                ->options(Question::all()->pluck('question'))
                                ->disabled(),
                            Forms\Components\Select::make('question_type')
                                ->options([
                                    '1' => 'Multiple Choice',
                                    '2' => 'Essay',
                                    '3' => 'Listening',
                                    '4' => 'Speaking',
                                ])
                                ->disabled(),

                            Forms\Components\TextInput::make('response')->disabled(),
                            Forms\Components\TextInput::make('point')->required(),
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
                Tables\Columns\TextColumn::make('answerable_type')->label('Type'),
                // Tables\Columns\TextColumn::make('answerable_id'),
                // Tables\Columns\TextColumn::make('answer'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnswers::route('/'),
            // 'create' => Pages\CreateAnswer::route('/create'),
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }
}
