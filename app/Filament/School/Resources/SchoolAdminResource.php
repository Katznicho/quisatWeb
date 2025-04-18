<?php

namespace App\Filament\School\Resources;

use App\Filament\School\Resources\SchoolAdminResource\Pages;
use App\Models\SchoolAdmin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SchoolAdminResource extends Resource
{
    protected static ?string $model = SchoolAdmin::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'School Management';
    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('school_id', auth()->user()->school_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('school_id')
                    ->default(auth()->user()->school_id),
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Role & Additional Information')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->options([
                                'principal' => 'Principal',
                                'vice_principal' => 'Vice Principal',
                                'coordinator' => 'Coordinator',
                                'administrator' => 'Administrator',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('join_date')
                            ->required(),
                        Forms\Components\Textarea::make('address')
                            ->rows(3),
                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->badge(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'principal' => 'Principal',
                        'vice_principal' => 'Vice Principal',
                        'coordinator' => 'Coordinator',
                        'administrator' => 'Administrator',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolAdmins::route('/'),
            'create' => Pages\CreateSchoolAdmin::route('/create'),
            'edit' => Pages\EditSchoolAdmin::route('/{record}/edit'),
        ];
    }
}
