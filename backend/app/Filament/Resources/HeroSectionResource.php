<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroSectionResource\Pages;
use App\Models\HeroSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    
    protected static ?string $navigationGroup = 'Website';
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $navigationLabel = 'Hero Section';

    public static function canCreate(): bool
    {
        // Only allow creating if no hero section exists
        return HeroSection::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Badge & Heading')
                    ->schema([
                        Forms\Components\TextInput::make('badge_text')
                            ->required()
                            ->maxLength(255)
                            ->label('Badge Text')
                            ->placeholder('#nexteam')
                            ->helperText('Small badge text at the top'),
                        Forms\Components\TextInput::make('heading')
                            ->required()
                            ->maxLength(255)
                            ->label('Main Heading')
                            ->placeholder('Innovate. Excellent!. Succeed!.')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->label('Description')
                            ->placeholder('Penyedia layanan teknologi...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Hero Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_light')
                            ->label('Hero Image')
                            ->image()
                            ->directory('hero')
                            ->imageEditor()
                            ->helperText('Recommended: 600x600px or larger')
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Primary Button')
                    ->schema([
                        Forms\Components\TextInput::make('primary_button_text')
                            ->required()
                            ->maxLength(255)
                            ->label('Button Text')
                            ->placeholder('View Projects'),
                        Forms\Components\TextInput::make('primary_button_url')
                            ->required()
                            ->maxLength(255)
                            ->label('Button URL')
                            ->placeholder('/project'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Secondary Button')
                    ->schema([
                        Forms\Components\Toggle::make('show_secondary_button')
                            ->label('Show Secondary Button')
                            ->default(true)
                            ->live()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('secondary_button_text')
                            ->maxLength(255)
                            ->label('Button Text')
                            ->placeholder('Watch Video')
                            ->visible(fn (Forms\Get $get) => $get('show_secondary_button')),
                        Forms\Components\TextInput::make('secondary_button_url')
                            ->maxLength(255)
                            ->label('Button URL (optional)')
                            ->placeholder('https://youtube.com/...')
                            ->helperText('Leave empty if no link needed')
                            ->visible(fn (Forms\Get $get) => $get('show_secondary_button')),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->label('Active')
                            ->helperText('Only one hero section should be active at a time'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('badge_text')
                    ->searchable()
                    ->label('Badge'),
                Tables\Columns\TextColumn::make('heading')
                    ->searchable()
                    ->limit(50)
                    ->label('Heading'),
                Tables\Columns\ImageColumn::make('image_light')
                    ->label('Hero Image')
                    ->square()
                    ->defaultImageUrl(url('/placeholder.svg')),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->label('Last Updated'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
