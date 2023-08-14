<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Assessment Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('subject_id')
                        ->relationship('subject', 'name')
                        ->label('Bahasa')
                        ->required(),
                    Forms\Components\DateTimePicker::make('start_at')
                        ->required(),
                    Forms\Components\DateTimePicker::make('end_at')
                        ->required(),
                    Forms\Components\TextInput::make('timer_in_minutes')
                        ->required()
                        ->numeric()
                        ->minValue(1),
                    Forms\Components\Toggle::make('is_active')->required()->inline(false)->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subject.name'),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('timer_in_minutes'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
