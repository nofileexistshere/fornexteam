<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    
    protected static ?string $navigationGroup = 'Website';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Project Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Project Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                                            ->maxLength(255)
                                            ->label('Project Name'),
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255)
                                            ->label('Slug')
                                            ->helperText('URL-friendly version'),
                                        Forms\Components\TextInput::make('client_name')
                                            ->maxLength(255)
                                            ->label('Client Name'),
                                        Forms\Components\TextInput::make('category')
                                            ->maxLength(255)
                                            ->label('Category'),
                                        Forms\Components\TextInput::make('project_url')
                                            ->url()
                                            ->maxLength(255)
                                            ->label('Project URL')
                                            ->placeholder('https://example.com'),
                                        Forms\Components\TextInput::make('order')
                                            ->numeric()
                                            ->default(0)
                                            ->label('Display Order')
                                            ->helperText('Lower numbers appear first'),
                                    ])->columns(2),
                                
                                Forms\Components\Section::make('Description')
                                    ->schema([
                                        Forms\Components\Textarea::make('description')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->label('Short Description')
                                            ->helperText('Brief project description')
                                            ->columnSpanFull(),
                                        Forms\Components\TagsInput::make('technologies')
                                            ->placeholder('Add technologies (React, Laravel, etc.)')
                                            ->label('Technologies')
                                            ->helperText('Press Enter after each technology')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Forms\Components\Section::make('Featured Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->image()
                                            ->directory('projects')
                                            ->imageEditor()
                                            ->label('Project Image')
                                            ->helperText('Recommended: 1200x800px. Leave empty to use placeholder.')
                                            ->columnSpanFull(),
                                    ]),
                                
                                Forms\Components\Section::make('Dates & Settings')
                                    ->schema([
                                        Forms\Components\DatePicker::make('start_date')
                                            ->label('Start Date'),
                                        Forms\Components\DatePicker::make('end_date')
                                            ->label('End Date'),
                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured Project')
                                            ->default(false),
                                        Forms\Components\Toggle::make('is_published')
                                            ->label('Published')
                                            ->default(true)
                                            ->helperText('Only published projects will be displayed'),
                                    ])->columns(2),
                            ]),

                        Forms\Components\Tabs\Tab::make('Detail Page Content')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Project Details')
                                    ->schema([
                                        Forms\Components\RichEditor::make('content')
                                            ->label('Project Content')
                                            ->fileAttachmentsDirectory('project-attachments')
                                            ->helperText('Detailed project information, process, results, etc.')
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('project_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
