<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssessmentResource\Pages;
use App\Filament\Resources\AssessmentResource\RelationManagers;
use App\Models\Assessment;
use App\Models\Subject;
use App\Models\Submodule;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Assessment Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->default(auth()->user()->id)
                            ->required(),

                        Forms\Components\Select::make('type')
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
                                    return [Forms\Components\MorphToSelect\Type::make(Subject::class)->titleColumnName('name')];
                                } else {
                                    return [Forms\Components\MorphToSelect\Type::make(Submodule::class)->titleColumnName('title')];
                                }
                            })
                            ->required(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('instruction')
                            ->maxLength(65535),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at'),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TimePicker::make('start_time'),
                            Forms\Components\TimePicker::make('end_time'),
                            Forms\Components\TextInput::make('duration_minutes')
                                ->numeric()
                                ->minValue(1),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
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
            RelationManagers\QuestionsRelationManager::class
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
