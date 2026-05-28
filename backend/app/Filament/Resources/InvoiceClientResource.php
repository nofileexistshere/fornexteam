<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceClientResource\Pages;
use App\Filament\Resources\InvoiceClientResource\RelationManagers;
use App\Models\InvoiceClient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceClientResource extends Resource
{
    protected static ?string $model = InvoiceClient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Clients';

    protected static ?string $modelLabel = 'Client';

    protected static ?string $pluralModelLabel = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Client Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Client')
                            ->placeholder('PT. Example Indonesia'),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(255)
                            ->label('No. Telepon')
                            ->placeholder('08123456789'),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->label('Email')
                            ->placeholder('client@example.com'),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->rows(3)
                            ->label('Alamat')
                            ->placeholder('Jl. Example No. 123, Jakarta')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->label('Telepon')
                    ->icon('heroicon-o-phone'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email')
                    ->icon('heroicon-o-envelope')
                    ->copyable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('Alamat')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->label('Ditambahkan')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
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
            'index' => Pages\ListInvoiceClients::route('/'),
            'create' => Pages\CreateInvoiceClient::route('/create'),
            'edit' => Pages\EditInvoiceClient::route('/{record}/edit'),
        ];
    }
}
