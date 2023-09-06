<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmoduleResource\Pages;
use App\Filament\Resources\SubmoduleResource\RelationManagers;
use App\Models\Module;
use App\Models\Submodule;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SubmoduleResource extends Resource
{
    protected static ?string $model = Submodule::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationLabel = 'Module';
    protected static ?string $label = 'Module';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('module_id')
                        ->relationship('module', 'title')
                        ->options(Module::all()->pluck('title', 'id'))
                        ->label('Level')
                        ->required()
                        ->searchable(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('list_sort')
                        ->label('No Urut')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\Toggle::make('is_visible')
                        ->label('Aktif')
                        ->default(true)
                        ->inline(false)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Module')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('module.title')
                    ->label('Level')
                    ->sortable()
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('Level')->relationship('module', 'title')->searchable(),
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Aktif')
                    ->searchable(),
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
            RelationManagers\ChaptersRelationManager::class,
            // RelationManagers\AssessmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmodules::route('/'),
            'create' => Pages\CreateSubmodule::route('/create'),
            'edit' => Pages\EditSubmodule::route('/{record}/edit'),
        ];
    }
}
