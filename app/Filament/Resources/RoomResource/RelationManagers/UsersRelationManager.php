<?php

namespace App\Filament\Resources\RoomResource\RelationManagers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'username';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Section::make('Fakultas/Prodi')
                            ->relationship('siakad')
                            ->schema([
                                Forms\Components\Select::make('faculty_id')
                                    ->label('Fakultas')
                                    ->relationship('faculty', 'name')
                                    ->options(Faculty::all()->pluck('name', 'id')),

                                Forms\Components\Select::make('department_id')
                                    ->label('Prodi')
                                    ->relationship('department', 'name')
                                    ->options(Department::all()->pluck('name', 'id')),
                            ])
                            ->visible(function (?User $record) {
                                return $record->siakad ? true : false;
                            })
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->label('No')->getStateUsing(
                    static function (stdClass $rowLoop, HasTable $livewire): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->tableRecordsPerPage * ($livewire->page - 1
                            ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('username'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('type')->label('Status')->enum([
                    '0' => 'Mahasiswa',
                    '1' => 'Dosen',
                ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Tambah')
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->multiple()
                            ->autofocus(),

                        Forms\Components\Select::make('type')
                            ->options([
                                '0' => 'Mahasiswa',
                                '1' => 'Dosen',
                            ])
                            ->default('0')
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DetachAction::make()->label('Keluarkan'),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
