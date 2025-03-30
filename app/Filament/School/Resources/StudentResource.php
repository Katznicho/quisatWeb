<?php

namespace App\Filament\School\Resources;

use App\Filament\School\Resources\StudentResource\Pages;
use App\Models\Student;
use App\Models\Guardian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Academic Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('admission_number')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('first_name')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->required(),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->required(),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->required()
                            ->maxDate(now()),
                    ])->columns(2),

                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone'),
                        Forms\Components\Textarea::make('address')
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Academic Information')
                    ->schema([
                        Forms\Components\Select::make('class_id')
                            ->relationship('class', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('guardian_id')
                            ->relationship('guardian', 'first_name')
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('first_name')
                                    ->required(),
                                Forms\Components\TextInput::make('last_name')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->required(),
                            ]),
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
                Tables\Columns\TextColumn::make('admission_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('class.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('guardian.first_name')
                    ->label('Guardian'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('class')
                    ->relationship('class', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
