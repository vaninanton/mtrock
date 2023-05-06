<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\RelationManagers\ProductsRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?string $navigationLabel = 'Товары';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Товар';

    protected static ?string $pluralModelLabel = 'Товары';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->disabled()
                                    ->required()
                                    ->unique(Product::class, 'slug', ignoreRecord: true),

                                Forms\Components\MarkdownEditor::make('description')
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('product-images')
                                    ->multiple()
                                    ->responsiveImages()
                                    ->conversion('thumb')
                                    ->maxFiles(5)
                                    ->disableLabel(),
                            ])
                            ->collapsible(),

                        Forms\Components\Section::make('Pricing')
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                Forms\Components\TextInput::make('old_price')
                                    ->label('Compare at price')
                                    ->numeric()
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->required(),

                                // Forms\Components\TextInput::make('cost')
                                //     ->label('Cost per item')
                                //     ->helperText('Customers won\'t see this price.')
                                //     ->numeric()
                                //     ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                //     ->required(),
                            ])
                            ->columns(2),
                        Forms\Components\Section::make('Inventory')
                            ->schema([
                                Forms\Components\TextInput::make('sku')
                                    ->label('SKU (Stock Keeping Unit)')
                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                    ->required(),

                                // Forms\Components\TextInput::make('barcode')
                                //     ->label('Barcode (ISBN, UPC, GTIN, etc.)')
                                //     ->unique(Product::class, 'barcode', ignoreRecord: true)
                                //     ->required(),

                                Forms\Components\TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->rules(['integer', 'min:0'])
                                    ->required(),

                                // Forms\Components\TextInput::make('security_stock')
                                //     ->helperText('The safety stock is the limit stock for your products which alerts you if the product stock will soon be out of stock.')
                                //     ->numeric()
                                //     ->rules(['integer', 'min:0'])
                                //     ->required(),
                            ])
                            ->columns(2),

                        // Forms\Components\Section::make('Shipping')
                        //     ->schema([
                        //         Forms\Components\Checkbox::make('backorder')
                        //             ->label('This product can be returned'),

                        //         Forms\Components\Checkbox::make('requires_shipping')
                        //             ->label('This product will be shipped'),
                        //     ])
                        //     ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Visible')
                                    ->helperText('This product will be hidden from all sales channels.')
                                    ->default(true),

                                // Forms\Components\DatePicker::make('published_at')
                                //     ->label('Availability')
                                //     ->default(now())
                                //     ->required(),
                            ]),

                        Forms\Components\Section::make('Associations')
                            ->schema([
                                Forms\Components\Select::make('brand_id')
                                    ->relationship('brand', 'title')
                                    ->searchable()
                                    ->hiddenOn(ProductsRelationManager::class),

                                Forms\Components\Select::make('category')
                                    ->relationship('category', 'title')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
        // return $form
        //     ->schema([
        //         Tabs::make('Товар')
        //             ->tabs([
        //                 Tabs\Tab::make('Основная информация')
        //                     ->schema([
        //                         Fieldset::make('Название товара')
        //                             ->schema([
        //                                 Forms\Components\TextInput::make('type_prefix')
        //                                     ->label('Префикс (тип)')
        //                                     ->maxLength(255),
        //                                 Forms\Components\Select::make('brand_id')
        //                                     ->label('Бренд')
        //                                     ->relationship('brand', 'title'),
        //                                 Forms\Components\TextInput::make('model')
        //                                     ->label('Модель')
        //                                     ->maxLength(255),
        //                                 Forms\Components\TextInput::make('title')
        //                                     ->label('Наименование')
        //                                     ->required()
        //                                     ->maxLength(255),
        //                                 Forms\Components\TextInput::make('short_description')
        //                                     ->maxLength(255),
        //                                 Forms\Components\TextInput::make('sku')
        //                                     ->label('Артикул')
        //                                     ->maxLength(255),
        //                                 Forms\Components\TextInput::make('slug')
        //                                     ->label('Slug')
        //                                     ->required()
        //                                     ->maxLength(255),
        //                                 Forms\Components\Select::make('category_id')
        //                                     ->label('Категория')
        //                                     ->relationship('category', 'title'),
        //                                 Forms\Components\Select::make('type_id')
        //                                     ->label('Тип товара')
        //                                     ->relationship('type', 'title'),
        //                             ])
        //                             ->columns(3),
        //                         Fieldset::make('Склад')
        //                             ->schema([
        //                                 Grid::make(4)
        //                                     ->schema([
        //                                         Forms\Components\TextInput::make('quantity')
        //                                             ->label('Количество на складе')
        //                                             ->numeric()
        //                                             ->minValue(0)
        //                                             ->required(),
        //                                         Forms\Components\Toggle::make('in_stock')
        //                                             ->label('На складе')
        //                                             ->required(),
        //                                         Forms\Components\Toggle::make('availability_preorder')
        //                                             ->label('Предзаказ')
        //                                             ->required(),
        //                                         Forms\Components\Toggle::make('status')
        //                                             ->label('Статус')
        //                                             ->required(),

        //                                         Forms\Components\TextInput::make('length')
        //                                             ->label('Длина, м')
        //                                             ->numeric(),
        //                                         Forms\Components\TextInput::make('width')
        //                                             ->label('Ширина, м')
        //                                             ->numeric(),
        //                                         Forms\Components\TextInput::make('height')
        //                                             ->label('Высота, м')
        //                                             ->numeric(),
        //                                         Forms\Components\TextInput::make('weight')
        //                                             ->label('Вес, кг')
        //                                             ->numeric(),
        //                                     ]),
        //                                 //
        //                             ]),
        //                         Grid::make(2)
        //                             ->schema([
        //                                 Forms\Components\TextInput::make('price')
        //                                     ->label('Цена')
        //                                     ->numeric()
        //                                     ->minValue(0)
        //                                     ->required(),
        //                                 Forms\Components\TextInput::make('old_price')
        //                                     ->label('Зачеркнутая цена')
        //                                     ->numeric()
        //                                     ->minValue(0),
        //                             ]),
        //                         Forms\Components\FileUpload::make('image')
        //                             ->directory('store/product'),
        //                     ]),
        //                 Tabs\Tab::make('Видео и комментарии')
        //                     ->schema([
        //                         Forms\Components\TextInput::make('sales_notes')
        //                             ->maxLength(255),
        //                         Forms\Components\TextInput::make('video1')
        //                             ->maxLength(255),
        //                         Forms\Components\TextInput::make('video2')
        //                             ->maxLength(255),
        //                         Forms\Components\TextInput::make('video3')
        //                             ->maxLength(255),
        //                         Forms\Components\RichEditor::make('description')
        //                             ->maxLength(65535),
        //                         Forms\Components\Toggle::make('flag_special')
        //                             ->required(),
        //                         Forms\Components\Toggle::make('flag_new')
        //                             ->required(),
        //                         Forms\Components\Toggle::make('flag_hit')
        //                             ->required(),
        //                         Forms\Components\TextInput::make('position')
        //                             ->required(),
        //                     ]),
        //             ]),
        //     ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sku')
                    ->label('Артикул')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
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
                // Tables\Columns\IconColumn::make('in_stock')
                //     ->label('На складе')
                //     ->boolean(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Статус'),
                Tables\Columns\TextColumn::make('old_price')
                    ->label('Старая цена')
                    ->money('RUB')
                    ->alignEnd()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('price')
                    ->label('Цена')
                    ->money('RUB')
                    ->alignEnd(),
                Tables\Columns\ToggleColumn::make('flag_special')
                    ->label('Акция')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('flag_new')
                    ->label('Новинка')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('flag_hit')
                    ->label('Хит')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('brand')
                    ->relationship('brand', 'title')
                    ->multiple()
                    ->label('Бренд'),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'title')
                    ->multiple()
                    ->label('Категория'),
                Tables\Filters\TernaryFilter::make('in_stock')
                    ->label('Статус'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                BulkAction::make('flag_special_true')
                    ->label('Включить акцию')
                    ->color('success')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_special = true;
                            $product->save();
                        });
                    }),
                BulkAction::make('flag_special_false')
                    ->label('Выключить акцию')
                    ->color('danger')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_special = false;
                            $product->save();
                        });
                    }),

                BulkAction::make('flag_new_true')
                    ->label('Включить новинку')
                    ->color('success')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_new = true;
                            $product->save();
                        });
                    }),
                BulkAction::make('flag_new_false')
                    ->label('Выключить новинку')
                    ->color('danger')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_new = false;
                            $product->save();
                        });
                    }),

                BulkAction::make('flag_hit_true')
                    ->label('Включить хит')
                    ->color('success')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_hit = true;
                            $product->save();
                        });
                    }),
                BulkAction::make('flag_hit_false')
                    ->label('Выключить хит')
                    ->color('danger')
                    ->action(function (Collection $records) {
                        $records->each(function (Product $product) {
                            $product->flag_hit = false;
                            $product->save();
                        });
                    }),
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

    /** @param  Product  $record */
    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['sku', 'title'];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) self::$model::count();
    }
}
