<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Questions Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\MorphToSelect::make('questionable')
                        ->types([
                            MorphToSelect\Type::make(Quiz::class)->titleColumnName('title'),
                            MorphToSelect\Type::make(Exam::class)->titleColumnName('title'),
                        ])
                        ->required(),

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
                        ->label(fn (callable $get): string => $get('type') == 3 ? 'Audio' : 'Image')
                        ->directory(fn (callable $get): string => $get('type') == 3 ? 'question-audio' : 'question-images')
                        ->acceptedFileTypes(['audio/mpeg', 'audio/ogg', 'audio/wav', 'image/jpeg', 'image/png', 'image/webp'])
                        ->imageResizeMode('cover')
                        ->imagePreviewHeight('200')
                        ->enableOpen()
                        ->maxSize(3024),

                    Forms\Components\Textarea::make('question'),
                ]),

                Forms\Components\Section::make('Options')
                    ->relationship('choices')
                    ->schema([
                        Forms\Components\Repeater::make('options')
                            ->schema([
                                Forms\Components\TextInput::make('id')->default(Str::password(5, symbols: false))->hidden(),

                                Forms\Components\FileUpload::make('image_path')
                                    ->directory('question-choices-images')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imagePreviewHeight('200')
                                    ->enableOpen()
                                    ->maxSize(3024)
                                    ->columnSpan([
                                        'md' => 3,
                                    ]),
                                Forms\Components\TextInput::make('choice')->columnSpan([
                                    'md' => 5,
                                ]),
                                Forms\Components\Toggle::make('is_correct')->inline(false)->columnSpan([
                                    'md' => 2
                                ]),
                            ])
                            ->disableLabel()
                            ->columns([
                                'md' => 10,
                            ])
                            ->createItemButtonLabel('Add Option'),
                    ])
                    ->visible(function (callable $get) {
                        return ($get('type') == '1') ? true : false;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('questionable.title')->label('Title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->enum([
                    '1' => 'Multiple Choice',
                    '2' => 'Essay',
                    '3' => 'Listenig',
                    '4' => 'Speaking',
                ]),
                Tables\Columns\TextColumn::make('question')->words(10)->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')->options([
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
