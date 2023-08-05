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
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Select::make('module_id')
                        ->relationship('module', 'title')
                        ->options(Module::all()->pluck('title', 'id'))
                        ->required()
                        ->searchable(),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('list_sort')
                        ->required()
                        ->maxLength(100),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('module.title')->label('Module Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Dibuat'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Terakhir diperbarui'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Module')->relationship('module', 'title')->searchable()
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
            RelationManagers\MaterialRelationManager::class,
            RelationManagers\QuizRelationManager::class,
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
