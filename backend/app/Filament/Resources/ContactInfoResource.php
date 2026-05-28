<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Filament\Resources\ContactInfoResource\RelationManagers;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationLabel = 'Contact Info';

    public static function canCreate(): bool
    {
        // Only allow creating if no contact info exists
        return ContactInfo::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder("let's get connected"),
                        Forms\Components\Textarea::make('description')
                            ->label('Page Description')
                            ->required()
                            ->rows(2)
                            ->placeholder('Memberdayakan bisnis Anda melalui teknologi. Hubungi kami sekarang!')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Chat Information')
                    ->schema([
                        Forms\Components\TextInput::make('chat_admin_name')
                            ->label('Admin Name')
                            ->maxLength(255)
                            ->placeholder('Senin - Jum\'at'),
                        Forms\Components\TextInput::make('chat_hours')
                            ->label('Chat Hours')
                            ->maxLength(255)
                            ->placeholder('09:00 to 18:00 WIB'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Address')
                    ->schema([
                        Forms\Components\TextInput::make('address_title')
                            ->label('Location Name')
                            ->maxLength(255)
                            ->placeholder('Jakarta'),
                        Forms\Components\Textarea::make('address_line1')
                            ->label('Address Line 1')
                            ->rows(2)
                            ->placeholder('Pasar Rebo - Jakarta Selatan, 16426')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('address_line2')
                            ->label('Address Line 2')
                            ->rows(2)
                            ->placeholder('Indonesia')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Map Settings')
                    ->schema([
                        Forms\Components\Textarea::make('map_embed_url')
                            ->label('Google Maps Embed URL')
                            ->rows(3)
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->helperText('Get embed URL from Google Maps → Share → Embed a map')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('map_latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->placeholder('-6.3308394'),
                        Forms\Components\TextInput::make('map_longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->placeholder('106.8500762'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Social Media')
                    ->schema([
                        Forms\Components\TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.tiktok.com/@fornexteam'),
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.instagram.com/fornexteam/'),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.linkedin.com/company/nofileexistshere/'),
                    ]),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Show or hide contact information on the website'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(40)
                    ->sortable(),
                Tables\Columns\TextColumn::make('address_title')
                    ->label('Location')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
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
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
