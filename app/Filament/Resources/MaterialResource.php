<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Models\Chapter;
use App\Models\Material;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'System Management';
    protected static ?string $navigationLabel = 'Materi';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('chapter_id')
                            ->relationship('chapter', 'title')
                            ->getOptionLabelFromRecordUsing(function (Chapter $record) {
                                return "Level: {$record->submodule->module->title} > Module: {$record->submodule->title} > Sub: {$record->title}";
                            })
                            ->label('Submodule')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),

                Forms\Components\Section::make('Sematan')
                    ->schema([
                        Forms\Components\Repeater::make('embed_links')
                            ->schema([
                                Forms\Components\Textarea::make('link'),
                            ])
                            ->label('Link (Google Slide/Youtube)')
                            ->defaultItems(0)
                            ->createItemButtonLabel('Tambahkan Link'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Teks')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Teks')
                            ->fileAttachmentsDirectory('attachments'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('chapter.title')
                    ->label('Judul Submodule')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('Chapter')
                    ->label('Submodule')
                    ->relationship('chapter', 'title')
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
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
