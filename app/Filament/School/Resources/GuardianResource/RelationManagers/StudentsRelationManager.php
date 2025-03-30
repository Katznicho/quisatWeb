<?php

namespace App\Filament\School\Resources\GuardianResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    public function form(Form $form): Form
    {
        return $form
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
                    ->required(),
                Forms\Components\Select::make('class_id')
                    ->relationship('class', 'name')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('first_name')
            ->columns([
                Tables\Columns\TextColumn::make('admission_number'),
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('class.name'),
                Tables\Columns\TextColumn::make('gender'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}