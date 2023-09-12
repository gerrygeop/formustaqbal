<?php

namespace App\Filament\Resources\AssessmentResource\RelationManagers;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\TextInput::make('name'),
                        Forms\Components\TextInput::make('username'),
                        Forms\Components\TextInput::make('email'),

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
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('score')->label('Nilai')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_completed')->label('')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('Review')
                    ->action(function (RelationManager $livewire, User $record) {
                        return redirect()->route('review.assessment', [$livewire->ownerRecord->id, $record]);
                    })
                    ->color('primary')
                    ->icon('heroicon-s-pencil'),

                Tables\Actions\Action::make('Reset')
                    ->action(function (RelationManager $livewire, User $record) {
                        return redirect()->route('reset.assessment', [$livewire->ownerRecord->id, $record]);
                    })
                    ->color('danger')
                    ->icon('heroicon-s-x')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
