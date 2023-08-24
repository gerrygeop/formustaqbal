<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Questions Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('assessment_id')
                        ->relationship('assessment', 'title')
                        ->required(),

                    Forms\Components\Select::make('type')
                        ->label('Jenis Soal')
                        ->required()
                        ->options([
                            '1' => 'Multiple Choice',
                            '2' => 'Essay',
                            '3' => 'Listening',
                            '4' => 'Speaking',
                        ])
                        ->reactive(),

                    Forms\Components\FileUpload::make('file_path')
                        ->label('Audio/Gambar')
                        ->directory(fn (callable $get): string => $get('type') == 3 ? 'question-audio' : 'question-images')
                        ->acceptedFileTypes(['audio/mpeg', 'audio/ogg', 'image/jpeg', 'image/png', 'image/webp'])
                        ->imageResizeMode('cover')
                        ->imagePreviewHeight('200')
                        ->enableOpen()
                        ->enableDownload()
                        ->maxSize(3024),

                    Forms\Components\RichEditor::make('question')
                        ->label('Pertanyaan')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                        ]),

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
                                ->label('Gambar (max: 3mb)')
                                ->directory('choices-images')
                                ->image()
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
                    ->words(10)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
