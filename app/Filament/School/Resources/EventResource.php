<?php

namespace App\Filament\School\Resources;

use App\Filament\School\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'School Management';
    protected static ?int $navigationSort = 2;

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
                Forms\Components\Section::make('Event Details')
                    ->description('Basic information about the event')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter event title')
                            ->columnSpan(2),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('events')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->columnSpan(2),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'orderedList',
                                'unorderedList',
                                'h2',
                                'h3',
                            ])
                            ->columnSpan(2),
                    ])->columns(2),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make('Schedule')
                            ->description('Event timing details')
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_date')
                                    ->required()
                                    ->native(false)
                                    ->hoursStep(1)
                                    ->minutesStep(15),
                                Forms\Components\DateTimePicker::make('end_date')
                                    ->required()
                                    ->native(false)
                                    ->hoursStep(1)
                                    ->minutesStep(15)
                                    ->after('start_date'),
                                Forms\Components\TextInput::make('location')
                                    ->required()
                                    ->placeholder('Event location'),
                            ]),

                        Forms\Components\Section::make('Classification')
                            ->description('Event type and status')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'academic' => 'Academic',
                                        'sports' => 'Sports',
                                        'cultural' => 'Cultural',
                                        'holiday' => 'Holiday',
                                    ])
                                    ->required()
                                    ->native(false),
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'scheduled' => 'Scheduled',
                                        'ongoing' => 'Ongoing',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->default('scheduled')
                                    ->required()
                                    ->native(false),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
