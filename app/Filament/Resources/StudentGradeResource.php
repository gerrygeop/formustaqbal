<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentGradeResource\Pages;
use App\Filament\Resources\StudentGradeResource\RelationManagers;
use App\Models\Department;
use App\Models\Local;
use App\Models\StudentGrade;
use App\Models\User;
use Filament\Forms\Components;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class StudentGradeResource extends Resource
{
    protected static ?string $model = StudentGrade::class;
    protected ?string $maxContentWidth = 'full';

    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $label = 'Nilai Siswa';
    protected static ?int $navigationSort = 20;


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Select::make('user_id')
                    ->label('NIM')
                    ->options(User::whereHas('siakad')->pluck('username', 'id'))
                    ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} {$record->username}")
                    ->required()
                    ->searchable(),
                // Components\TextInput::make('author'),
                Components\TextInput::make('c1')->label('Partisipasi')
                    ->numeric()
                    ->placeholder('0.00'),
                Components\TextInput::make('c2')->label('Tugas/Kuis')
                    ->numeric()
                    ->placeholder('0.00'),
                Components\TextInput::make('c3')->label('UTS')
                    ->numeric()
                    ->placeholder('0.00'),
                Components\TextInput::make('c4')->label('UAS')
                    ->numeric()
                    ->placeholder('0.00'),
                Components\TextInput::make('result')->label('Nilai Akhir')
                    ->numeric()
                    ->placeholder('0.00'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')->label('NIM')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.siakad.department.name')->label('Prodi'),
                Tables\Columns\TextColumn::make('c1')->label('Partisipasi')->placeholder('0.00')->sortable(),
                Tables\Columns\TextColumn::make('c2')->label('Tugas')->placeholder('0.00')->sortable(),
                Tables\Columns\TextColumn::make('c3')->label('UTS')->placeholder('0.00')->sortable(),
                Tables\Columns\TextColumn::make('c4')->label('UAS')->placeholder('0.00')->sortable(),
                Tables\Columns\TextColumn::make('result')->label('Nilai Akhir')->placeholder('0.00')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->label('Prodi')
                    ->options(fn () => Department::all()->pluck('name', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if (blank($data['value'])) {
                            return $query;
                        }
                        return $query->whereHas('user.siakad', fn ($query) => $query->where('department_id', $data['value']));
                    }),
                Tables\Filters\SelectFilter::make('local')
                    ->label('Lokal')
                    ->options(fn () => Local::all()->pluck('name', 'id'))
                    ->query(function (Builder $query, array $data) {
                        if (blank($data['value'])) {
                            return $query;
                        }
                        return $query->whereHas('user.siakad', fn ($query) => $query->where('local_id', $data['value']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageStudentGrades::route('/'),
        ];
    }
}
