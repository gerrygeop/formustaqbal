<?php

namespace App\Filament\Resources\AssessmentResource\RelationManagers;

use App\Models\Question;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use stdClass;

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
                        ->label('Jenis Soal')
                        ->required()
                        ->options([
                            '1' => 'Multiple Choice',
                            '2' => 'Essay',
                            '3' => 'Listening',
                            '4' => 'Speaking',
                        ])
                        ->default('1')
                        ->reactive(),

                    Forms\Components\FileUpload::make('file_path')
                        ->label('Audio')
                        ->directory('question-audio')
                        ->acceptedFileTypes(['audio/mpeg', 'audio/ogg'])
                        ->imageResizeMode('cover')
                        ->imagePreviewHeight('200')
                        ->enableOpen()
                        ->enableDownload()
                        ->maxSize(3024),

                    Forms\Components\RichEditor::make('question')
                        ->label('Pertanyaan')
                        ->required(),

                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\TextInput::make('point')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        Forms\Components\Toggle::make('is_choice_rtl')
                            ->label('Teks Pilihan Dari Kanan')
                            ->inline(false)
                            ->default(false)
                            ->visible(fn (callable $get): bool => $get('type') == 1 ? true : false),
                    ]),

                    Forms\Components\Repeater::make('choices')
                        ->relationship('choices')
                        ->schema([
                            Forms\Components\FileUpload::make('image_path')
                                ->label('Gambar/Audio (max: 3mb)')
                                ->directory('choices-images')
                                ->acceptedFileTypes(['audio/mpeg', 'audio/ogg', 'image/jpeg', 'image/png', 'image/webp'])
                                ->imageResizeMode('cover')
                                ->imagePreviewHeight('200')
                                ->enableOpen()
                                ->enableDownload()
                                ->maxSize(3024)
                                ->columnSpan([
                                    'md' => 3,
                                ]),
                            Forms\Components\TextInput::make('choice')->label('Teks')->columnSpan([
                                'md' => 8,
                            ]),
                            Forms\Components\Toggle::make('is_correct')
                                ->label('Benar')
                                ->inline(false)
                                ->columnSpan([
                                    'md' => 1
                                ]),
                        ])
                        ->label('Pilihan')
                        ->columns([
                            'md' => 12,
                        ])
                        ->createItemButtonLabel('Tambah Pilihan')
                        ->visible(function (callable $get) {
                            return ($get('type') == '1') ? true : false;
                        }),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->getStateUsing(
                        static function (stdClass $rowLoop, HasTable $livewire): string {
                            return (string) ($rowLoop->iteration + ($livewire->tableRecordsPerPage * ($livewire->page - 1)));
                        }
                    ),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis Soal')
                    ->enum([
                        '1' => 'Multiple Choice',
                        '2' => 'Essay',
                        '3' => 'Listenig',
                        '4' => 'Speaking',
                    ]),

                Tables\Columns\TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(5)
                    ->searchable()
                    ->placeholder('-')
                    ->html(),

                Tables\Columns\TextColumn::make('point')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis Soal')
                    ->options([
                        '1' => 'Multiple Choice',
                        '2' => 'Essay',
                        '3' => 'Listening',
                        '4' => 'Speaking',
                    ]),
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
