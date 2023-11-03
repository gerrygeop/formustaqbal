<?php

namespace App\Filament\Resources\ChapterResource\RelationManagers;

use App\Models\Assessment;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class AssessmentRelationManager extends RelationManager
{
    protected static string $relationship = 'assessment';
    protected static ?string $label = 'Quiz';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Forms\Components\Select::make('creator_id')
                        //     ->relationship('creator', 'name')
                        //     ->options(User::whereHas('roles', fn ($query) => $query->where('name', 'teacher'))->pluck('name', 'id'))
                        //     ->default(auth()->user()->id)
                        //     ->label('Created by')
                        //     ->required(),

                        Forms\Components\Select::make('type')
                            ->label('Type Assessment')
                            ->options([
                                '1' => 'Quiz',
                                '3' => 'Exam',
                            ])
                            ->default(1)
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('instruction')
                            ->disableAllToolbarButtons(),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\DateTimePicker::make('published_at')->default(now()),
                            Forms\Components\TextInput::make('duration_minutes')
                                ->numeric()
                                ->default(5)
                                ->minValue(1),
                            Forms\Components\TextInput::make('question_limit')
                                ->numeric()
                                ->minValue(0),
                        ]),
                    ]),

                Forms\Components\Section::make('Opsi')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        Forms\Components\Toggle::make('is_random_questions')
                            ->label('Soal acak')
                            ->default(false),
                        Forms\Components\Toggle::make('is_random_choices')
                            ->label('Pilihan ganda acak')
                            ->default(false),
                        Forms\Components\Toggle::make('is_previewable')
                            ->label('Preview Soal')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn (Assessment $record): string => route('filament.resources.assessments.edit', $record)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
