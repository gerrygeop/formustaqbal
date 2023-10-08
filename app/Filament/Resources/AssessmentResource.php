<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssessmentResource\Pages;
use App\Filament\Resources\AssessmentResource\RelationManagers;
use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Quiz/Exam/Test';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Forms\Components\Select::make('creator_id')
                        //     ->relationship('creator', 'name')
                        //     ->default(auth()->user()->id)
                        //     ->label('Created by')
                        //     ->required(),

                        Forms\Components\Select::make('type')
                            ->label('Type Assessment')
                            ->options([
                                '1' => 'Quiz',
                                '2' => 'Placement Test',
                                '3' => 'Exam',
                            ])
                            ->default('1')
                            ->required()
                            ->reactive(),

                        Forms\Components\MorphToSelect::make('assessmentable')
                            ->types(function (callable $get) {
                                if ($get('type') == '2') {
                                    return [Forms\Components\MorphToSelect\Type::make(Course::class)->titleColumnName('name')->label('Bahasa')];
                                } else {
                                    return [
                                        Forms\Components\MorphToSelect\Type::make(Chapter::class)
                                            ->titleColumnName('title')
                                            ->getOptionLabelFromRecordUsing(function (Chapter $record) {
                                                return "Level: {$record->submodule->module->title} > Module: {$record->submodule->title} > Sub: {$record->title}";
                                            })
                                            ->label('Submodule')
                                    ];
                                }
                            })
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\RichEditor::make('instruction')
                            ->label('Intruksi')
                            ->disableAllToolbarButtons(),
                    ])
                    ->columnSpan(['lg' => 2]),


                Forms\Components\Group::make()
                    ->schema([
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
                            ]),
                    ])->columnSpan(1),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')->default(now()),
                        // Forms\Components\TimePicker::make('start_time'),
                        // Forms\Components\TimePicker::make('end_time'),
                        Forms\Components\TextInput::make('duration_minutes')
                            ->label('Durasi')
                            ->numeric()
                            ->default(5)
                            ->minValue(0),
                        Forms\Components\TextInput::make('question_limit')
                            ->label('Batas Soal')
                            ->numeric()
                            ->minValue(0),
                    ])->columnSpan(['lg' => 2]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('creator.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->enum([
                        '1' => 'Quiz',
                        '2' => 'Placement Test',
                        '3' => 'Exam',
                    ]),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        '1' => 'Quiz',
                        '2' => 'Placement Test',
                        '3' => 'Exam',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\QuestionsRelationManager::class,
            RelationManagers\UsersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
        ];
    }
}
