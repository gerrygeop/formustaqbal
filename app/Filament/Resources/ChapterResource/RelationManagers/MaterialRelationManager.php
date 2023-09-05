<?php

namespace App\Filament\Resources\ChapterResource\RelationManagers;

use App\Models\Material;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialRelationManager extends RelationManager
{
    protected static string $relationship = 'material';
    protected static ?string $label = 'Materi';
    protected static ?string $recordTitleAttribute = 'content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Repeater::make('embed_links')
                            ->schema([
                                Forms\Components\Textarea::make('link'),
                            ])
                            ->label('Sematkan')
                            ->defaultItems(0),
                        Forms\Components\RichEditor::make('content')
                            ->fileAttachmentsDirectory('attachments'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Materi')
                    ->formatStateUsing(fn (string $state): string => __("Materi.{$state}")),
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
                Tables\Actions\EditAction::make()->url(fn (Material $record): string => route('filament.resources.materials.edit', $record)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
