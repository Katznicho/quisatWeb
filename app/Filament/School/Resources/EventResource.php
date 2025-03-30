<?php

namespace App\Filament\School\Resources;

use App\Filament\School\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'School Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('banner')
                            ->image()
                            ->imageEditor()
                            ->directory('events')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\DateTimePicker::make('start_date')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_date')
                            ->required()
                            ->after('start_date'),
                        Forms\Components\TextInput::make('location')
                            ->required(),
                        Forms\Components\Select::make('type')
                            ->options([
                                'academic' => 'Academic',
                                'sports' => 'Sports',
                                'cultural' => 'Cultural',
                                'holiday' => 'Holiday',
                            ])
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'scheduled' => 'Scheduled',
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('scheduled')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'academic',
                        'success' => 'sports',
                        'warning' => 'cultural',
                        'danger' => 'holiday',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'scheduled',
                        'warning' => 'ongoing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'academic' => 'Academic',
                        'sports' => 'Sports',
                        'cultural' => 'Cultural',
                        'holiday' => 'Holiday',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
