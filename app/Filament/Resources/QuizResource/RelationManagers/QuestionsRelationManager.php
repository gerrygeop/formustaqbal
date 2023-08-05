<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Question;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';
    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Select::make('type')
                        ->required()
                        ->options([
                            '1' => 'Multiple Choice',
                            '2' => 'Essay',
                            '3' => 'Listening',
                            '4' => 'Speaking',
                        ])
                        ->reactive(),

                    Forms\Components\FileUpload::make('file_path')
                        ->label('Audio/Image')
                        ->directory(fn (callable $get): string => $get('type') == 3 ? 'question-audio' : 'question-images')
                        ->acceptedFileTypes(['audio/mpeg', 'audio/ogg', 'audio/wav', 'image/jpeg', 'image/png', 'image/webp'])
                        ->imageResizeMode('cover')
                        ->imagePreviewHeight('200')
                        ->enableOpen()
                        ->maxSize(3024),

                    Forms\Components\Textarea::make('question'),
                    Forms\Components\Toggle::make('is_active')->required()->default(true),

                    Forms\Components\Repeater::make('choices')
                        ->label('Options')
                        ->relationship()
                        ->schema([
                            Forms\Components\FileUpload::make('image_path')
                                ->disableLabel()
                                ->directory('question-choice-images')
                                ->image()
                                ->imageResizeMode('cover')
                                ->imagePreviewHeight('200')
                                ->enableOpen()
                                ->maxSize(3024)
                                ->columnSpan([
                                    'md' => 3,
                                ]),
                            Forms\Components\TextInput::make('choice')->disableLabel()->columnSpan([
                                'md' => 5,
                            ]),
                            Forms\Components\Toggle::make('is_correct')->columnSpan([
                                'md' => 2
                            ]),
                        ])
                        ->columns([
                            'md' => 10,
                        ])
                        ->createItemButtonLabel('Add Option')
                        ->visible(function (callable $get) {
                            return ($get('type') == '1') ? true : false;
                        }),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->enum([
                    '1' => 'Multiple Choice',
                    '2' => 'Essay',
                    '3' => 'Listenig',
                    '4' => 'Speaking',
                ]),
                Tables\Columns\TextColumn::make('question')->words(10)->searchable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options([
                    '1' => 'Multiple Choice',
                    '2' => 'Essay',
                    '3' => 'Listening',
                    '4' => 'Speaking',
                ]),
                Tables\Filters\TernaryFilter::make('is_active')
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn (Question $record): string => route('filament.resources.questions.edit', $record)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
