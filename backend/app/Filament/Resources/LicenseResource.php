<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenseResource\Pages;
use App\Filament\Resources\LicenseResource\RelationManagers;
use App\Models\License;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicenseResource extends Resource
{
    protected static ?string $model = License::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    
    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 14;

    public static function canCreate(): bool
    {
        // Only allow creating if no license exists
        return License::count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Page Header')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->default('License'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(1),
                
                Forms\Components\Section::make('Detail Legal')
                    ->description('Informasi NIB dan data perusahaan')
                    ->schema([
                        Forms\Components\TextInput::make('nib')
                            ->label('NIB')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('npwp')
                            ->label('NPWP')
                            ->maxLength(255)
                            ->placeholder('-'),
                        Forms\Components\TextInput::make('company_name')
                            ->label('Nama Perusahaan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('category')
                            ->label('Kategori')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
                
                Forms\Components\Section::make('Riwayat Proses')
                    ->description('Tahapan penerbitan NIB')
                    ->schema([
                        Forms\Components\Repeater::make('process_history')
                            ->label('Process Steps')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul (e.g., REC OSS)')
                                    ->required(),
                                Forms\Components\TextInput::make('description')
                                    ->label('Deskripsi')
                                    ->required(),
                                Forms\Components\TextInput::make('date')
                                    ->label('Tanggal')
                                    ->required()
                                    ->placeholder('22 Juli 2025 16:08'),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Ringkasan Terms & Privacy')
                    ->schema([
                        Forms\Components\Repeater::make('terms_summary')
                            ->label('Terms (Singkat)')
                            ->schema([
                                Forms\Components\Textarea::make('item')
                                    ->label('Point')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                        
                        Forms\Components\Repeater::make('privacy_summary')
                            ->label('Privacy (Singkat)')
                            ->schema([
                                Forms\Components\Textarea::make('item')
                                    ->label('Point')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nib')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLicenses::route('/'),
            'create' => Pages\CreateLicense::route('/create'),
            'edit' => Pages\EditLicense::route('/{record}/edit'),
        ];
    }
}
