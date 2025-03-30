<?php

namespace App\Filament\School\Resources;

use App\Filament\School\Resources\GuardianResource\Pages;
use App\Filament\School\Resources\GuardianResource\RelationManagers;
use App\Models\Guardian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Academic Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->required(),
                        Forms\Components\TextInput::make('alternate_phone'),
                        Forms\Components\TextInput::make('occupation'),
                    ])->columns(2),

                Forms\Components\Section::make('Address Information')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->rows(3),
                        Forms\Components\TextInput::make('city'),
                        Forms\Components\TextInput::make('state'),
                        Forms\Components\TextInput::make('postal_code'),
                    ])->columns(2),

                Forms\Components\Section::make('Relationship & Identity')
                    ->schema([
                        Forms\Components\Select::make('relationship')
                            ->options([
                                'father' => 'Father',
                                'mother' => 'Mother',
                                'grandfather' => 'Grandfather',
                                'grandmother' => 'Grandmother',
                                'uncle' => 'Uncle',
                                'aunt' => 'Aunt',
                                'brother' => 'Brother',
                                'sister' => 'Sister',
                                'legal_guardian' => 'Legal Guardian',
                                'other' => 'Other',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('national_id'),
                        Forms\Components\TextInput::make('passport_number'),
                    ])->columns(2),

                Forms\Components\Section::make('Emergency Contact')
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name'),
                        Forms\Components\TextInput::make('emergency_contact_phone'),
                        Forms\Components\TextInput::make('emergency_contact_relationship'),
                        Forms\Components\Textarea::make('additional_notes')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('relationship')
                    ->badge(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('students_count')
                    ->counts('students')
                    ->label('Students'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('relationship'),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\StudentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuardians::route('/'),
            'create' => Pages\CreateGuardian::route('/create'),
            'edit' => Pages\EditGuardian::route('/{record}/edit'),
        ];
    }
}
