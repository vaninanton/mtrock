<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\RelationManagers\ProductRelationManager;
use App\Filament\Resources\BrandResource\Pages;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $slug = 'shop/brands';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Бренды';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Бренд';

    protected static ?string $pluralModelLabel = 'Бренды';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Название бренда')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(Brand::class, 'slug', ignoreRecord: true),
                            ]),

                        Forms\Components\FileUpload::make('image')
                            ->label('Изображение')
                            ->directory('store/brand'),

                        Forms\Components\TextInput::make('short_description')
                            ->label('Краткое описание'),
                        Forms\Components\RichEditor::make('description')
                            ->label('Описание'),
                    ])
                    ->columnSpan(['lg' => fn (?Brand $record) => $record === null ? 3 : 2]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Brand $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Brand $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Brand $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\ImageColumn::make('image')
                //     ->label('Изображение'),
                Tables\Columns\BadgeColumn::make('products_count')
                    ->sortable()
                    ->label('Позиций'),
                Tables\Columns\BadgeColumn::make('products_active')
                    ->sortable()
                    ->label('В наличии'),
                Tables\Columns\BadgeColumn::make('products_quantity')
                    ->label('На складе')
                    ->sortable(),
            ])
            ->defaultSort('position', 'asc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title'];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::count();
    }
}
