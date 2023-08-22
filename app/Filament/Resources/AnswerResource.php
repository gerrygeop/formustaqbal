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
                    Forms\Components\Select::make('user')->relationship('user', 'name')->disabled(),
                    Forms\Components\Repeater::make('answer')
                        ->schema([
                            Forms\Components\Select::make('question_type')
                                ->options([
                                    '1' => 'Multiple Choice',
                                    '2' => 'Essay',
                                    '3' => 'Listening',
                                    '4' => 'Speaking',
                                ])
                                ->disabled()
                                ->reactive(),

                            Forms\Components\Select::make('question_id')
                                ->label('Question')
                                ->options(
                                    Question::all()->mapWithKeys(function ($item) {
                                        return [$item->id => $item->question];
                                    })
                                )
                                ->disabled(),

                            Forms\Components\TextInput::make('answer_text')
                                ->disabled()
                                ->visible(function (callable $get) {
                                    return ($get('question_type') != '4') ? true : false;
                                }),

                            Forms\Components\FileUpload::make('file_path')
                                ->label('Audio')
                                ->directory('speaking-test')
                                ->acceptedFileTypes(['audio/mpeg', 'audio/ogg', 'audio/wav'])
                                ->enableOpen()
                                ->enableDownload()
                                ->panelAspectRatio('8:1')
                                ->disabled()
                                ->maxSize(3024)
                                ->visible(function (callable $get) {
                                    return ($get('question_type') == '4') ? true : false;
                                }),

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
            ->bulkActions([]);
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
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }
}
