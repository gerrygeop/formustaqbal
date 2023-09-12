<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Local;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn (Page $livewire): bool =>  $livewire instanceof CreateRecord)
                            ->minLength(8)
                            ->same('passwordConfirmation')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->label('Password Confirmation')
                            ->password()
                            ->required(fn (Page $livewire): bool =>  $livewire instanceof CreateRecord)
                            ->minLength(8)
                            ->dehydrated(false),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Role')
                            ->schema([
                                Forms\Components\Select::make('roles')
                                    ->multiple()
                                    ->relationship('roles', 'name')
                                    ->options(Role::all()->pluck('name', 'id'))
                                    ->reactive(),
                            ]),

                        Forms\Components\Section::make('Fakultas/Prodi')
                            ->relationship('siakad')
                            ->schema([
                                Forms\Components\Select::make('faculty_id')
                                    ->relationship('faculty', 'name')
                                    ->options(Faculty::all()->pluck('name', 'id'))
                                    ->required()
                                    ->reactive(),

                                Forms\Components\Select::make('department_id')
                                    ->relationship('department', 'name')
                                    ->options(function (callable $get) {
                                        $faculties = Faculty::find($get('faculty_id'));

                                        return is_null($faculties) ?
                                            Department::all()->pluck('name', 'id') :
                                            $faculties->departments->pluck('name', 'id');
                                    })
                                    ->required()
                                    ->reactive(),

                                Forms\Components\Select::make('local_id')
                                    ->relationship('local', 'name')
                                    ->options(function (callable $get) {
                                        $departments = Department::find($get('department_id'));

                                        return is_null($departments) ?
                                            Local::all()->pluck('name', 'id') :
                                            $departments->locals->pluck('name', 'id');
                                    })
                                    ->required(),
                            ])
                            ->visible(function (callable $get) {
                                return (in_array(5, $get('roles'))) ? true : false;
                            })
                    ])
                    ->columnSpan(1),

                Forms\Components\Section::make('Info Tambahan')
                    ->relationship('profile')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('No Telp')
                            ->tel()
                            ->telRegex('/^(?:\+62|0)[1-9][0-9]{8,}$/'),

                        Forms\Components\Radio::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ]),

                        Forms\Components\Textarea::make('bio'),
                    ])
                    ->columnSpan(['lg' => 2]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->placeholder('-'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('roles')->relationship('roles', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
