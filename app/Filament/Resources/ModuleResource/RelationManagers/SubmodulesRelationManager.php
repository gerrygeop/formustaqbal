<?php

namespace App\Filament\Resources\ModuleResource\RelationManagers;

use App\Models\Submodule;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SubmodulesRelationManager extends RelationManager
{
    protected static string $relationship = 'submodules';
    protected static ?string $label = 'Module';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('list_sort')
                            ->label('No Urut')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->maxLength(100),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('list_sort')
                    ->label('No Urut')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Dibuat')
                    ->placeholder('-')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->label('Terakhir diperbarui')
                    ->dateTime(),
            ])
            ->defaultSort('list_sort')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn (Submodule $record): string => route('filament.resources.submodules.edit', $record)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
