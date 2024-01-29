<?php

namespace App\Filament\Resources\ModuleResource\RelationManagers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Filament\Forms\Components;
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
                Components\Grid::make(1)
                    ->schema([
                        Components\TextInput::make('name'),
                        Components\TextInput::make('username'),

                        Components\Section::make('Fakultas/Prodi')
                            ->relationship('siakad')
                            ->schema([
                                Components\Select::make('faculty_id')
                                    ->label('Fakultas')
                                    ->relationship('faculty', 'name')
                                    ->options(Faculty::all()->pluck('name', 'id')),

                                Components\Select::make('department_id')
                                    ->label('Prodi')
                                    ->relationship('department', 'name')
                                    ->options(Department::all()->pluck('name', 'id'))
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
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->getStateUsing(
                        static function (stdClass $rowLoop, HasTable $livewire): string {
                            return (string) ($rowLoop->iteration + ($livewire->tableRecordsPerPage * ($livewire->page - 1)));
                        }
                    ),

                Tables\Columns\TextColumn::make('username'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('modules.course_id'),
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

                        Components\Select::make('course_id')
                            ->label('Bahasa')
                            ->options(function (RelationManager $livewire): array {
                                return $livewire->ownerRecord->course()
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->default(function (RelationManager $livewire) {
                                return $livewire->ownerRecord->course_id;
                            })
                            ->required()
                            ->disabled(),
                    ])
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
