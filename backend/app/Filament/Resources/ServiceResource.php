<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    
    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Service Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Service Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                                                $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                                            )
                                            ->label('Service Name'),
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->label('Slug')
                                            ->helperText('URL-friendly version'),
                                        Forms\Components\Select::make('icon')
                                            ->options([
                                                'monitor' => 'Monitor (Desktop)',
                                                'palette' => 'Palette (Design)',
                                                'globe' => 'Globe (Internet)',
                                                'smartphone' => 'Smartphone (Mobile)',
                                                'cpu' => 'CPU (Operating System)',
                                                'life-buoy' => 'Life Buoy (Support)',
                                                'code' => 'Code (Development)',
                                                'app-window' => 'App Window',
                                            ])
                                            ->required()
                                            ->label('Icon')
                                            ->helperText('Select icon to display on the card'),
                                        Forms\Components\TextInput::make('order')
                                            ->required()
                                            ->numeric()
                                            ->default(0)
                                            ->label('Display Order')
                                            ->helperText('Lower numbers appear first'),
                                    ])
                                    ->columns(2),
                                
                                Forms\Components\Section::make('Description')
                                    ->schema([
                                        Forms\Components\Textarea::make('short_description')
                                            ->maxLength(300)
                                            ->rows(2)
                                            ->label('Short Description')
                                            ->helperText('Brief description (max 300 chars)')
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('description')
                                            ->required()
                                            ->maxLength(500)
                                            ->rows(4)
                                            ->label('Full Description')
                                            ->helperText('Detailed description (max 500 chars)')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Forms\Components\Section::make('Service Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image')
                                            ->label('Service Image')
                                            ->image()
                                            ->directory('services')
                                            ->imageEditor()
                                            ->helperText('Recommended: 800x600px. Leave empty to use placeholder.')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Forms\Components\Section::make('Additional Settings')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->default(true)
                                            ->helperText('Only active services will be displayed'),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Detail Page Content')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Why Need This Service')
                                    ->schema([
                                        Forms\Components\Textarea::make('why_need')
                                            ->label('Why Need This Service?')
                                            ->rows(3)
                                            ->helperText('Explain why customer needs this service')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Benefits / Use Cases')
                                    ->schema([
                                        Forms\Components\Repeater::make('benefits')
                                            ->label('Benefits List')
                                            ->schema([
                                                Forms\Components\TextInput::make('text')
                                                    ->label('Benefit Item')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->defaultItems(0)
                                            ->addActionLabel('Add Benefit')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Workflow / Process')
                                    ->schema([
                                        Forms\Components\Repeater::make('workflow')
                                            ->label('Workflow Steps')
                                            ->schema([
                                                Forms\Components\TextInput::make('step')
                                                    ->label('Step Description')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->defaultItems(0)
                                            ->addActionLabel('Add Step')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Platforms / Technologies')
                                    ->schema([
                                        Forms\Components\Repeater::make('platforms')
                                            ->label('Platform List')
                                            ->schema([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Platform Name')
                                                    ->required()
                                                    ->maxLength(100),
                                            ])
                                            ->defaultItems(0)
                                            ->addActionLabel('Add Platform')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Contact Message')
                                    ->schema([
                                        Forms\Components\Textarea::make('contact_message')
                                            ->label('Contact Call-to-Action Message')
                                            ->rows(3)
                                            ->helperText('Custom message for contact section on detail page')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug copied!')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('icon')
                    ->badge()
                    ->label('Icon'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->square()
                    ->defaultImageUrl(url('/placeholder.svg')),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->label('Updated'),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
