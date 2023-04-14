<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationLabel = 'Товары';

    protected static ?string $modelLabel = 'Товар';

    protected static ?string $pluralModelLabel = 'Товары';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Товар')
                    ->tabs([
                        Tabs\Tab::make('Основная информация')
                            ->schema([
                                Fieldset::make('Название товара')
                                    ->schema([
                                        Forms\Components\TextInput::make('type_prefix')
                                            ->label('Префикс (тип)')
                                            ->maxLength(255),
                                        Forms\Components\Select::make('brand_id')
                                            ->label('Бренд')
                                            ->relationship('brand', 'title'),
                                        Forms\Components\TextInput::make('model')
                                            ->label('Модель')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('title')
                                            ->label('Наименование')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('short_description')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('sku')
                                            ->label('Артикул')
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('category_id')
                                            ->label('Категория')
                                            ->relationship('category', 'title'),
                                        Forms\Components\Select::make('type_id')
                                            ->label('Тип товара')
                                            ->relationship('type', 'title'),
                                    ])
                                    ->columns(3),
                                Fieldset::make('Склад')
                                    ->schema([
                                        Grid::make(4)
                                            ->schema([
                                                Forms\Components\TextInput::make('quantity')
                                                    ->label('Количество на складе')
                                                    ->numeric()
                                                    ->minValue(0)
                                                    ->required(),
                                                Forms\Components\Toggle::make('in_stock')
                                                    ->label('На складе')
                                                    ->required(),
                                                Forms\Components\Toggle::make('availability_preorder')
                                                    ->label('Предзаказ')
                                                    ->required(),
                                                Forms\Components\Toggle::make('status')
                                                    ->label('Статус')
                                                    ->required(),

                                                Forms\Components\TextInput::make('length')
                                                    ->label('Длина, м')
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('width')
                                                    ->label('Ширина, м')
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('height')
                                                    ->label('Высота, м')
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('weight')
                                                    ->label('Вес, кг')
                                                    ->numeric(),
                                            ]),
                                        //
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->label('Цена')
                                            ->numeric()
                                            ->minValue(0)
                                            ->required(),
                                        Forms\Components\TextInput::make('old_price')
                                            ->label('Зачеркнутая цена')
                                            ->numeric()
                                            ->minValue(0),
                                    ]),
                                Forms\Components\FileUpload::make('image')
                                    ->directory('store/product'),
                            ]),
                        Tabs\Tab::make('Видео и комментарии')
                            ->schema([
                                Forms\Components\TextInput::make('sales_notes')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('video1')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('video2')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('video3')
                                    ->maxLength(255),
                                Forms\Components\RichEditor::make('description')
                                    ->maxLength(65535),
                                Forms\Components\Toggle::make('flag_special')
                                    ->required(),
                                Forms\Components\Toggle::make('flag_new')
                                    ->required(),
                                Forms\Components\Toggle::make('flag_hit')
                                    ->required(),
                                Forms\Components\TextInput::make('position')
                                    ->required(),
                            ]),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->label('Артикул')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->label('Наименование'),
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категория')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('brand.title')
                    ->label('Бренд')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('type.title')
                    ->label('Тип')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Количество'),
                Tables\Columns\IconColumn::make('in_stock')
                    ->label('На складе')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Статус')
                    ->boolean(),
                Tables\Columns\TextColumn::make('old_price')
                    ->label('Старая цена')
                    ->money('RUB', false)
                    ->alignEnd()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB', false)
                    ->alignEnd(),
                Tables\Columns\IconColumn::make('flag_special')
                    ->label('Акция')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('flag_new')
                    ->label('Новинка')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('flag_hit')
                    ->label('Хит')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('brand')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
