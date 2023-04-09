<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductImageResource\Pages;
use App\Models\ProductImage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductImageResource extends Resource
{
    protected static ?string $model = ProductImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationLabel = 'Изображения товаров';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'title')
                    ->required(),
                Forms\Components\TextInput::make('path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alt')
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.title'),
                Tables\Columns\TextColumn::make('path'),
                Tables\Columns\TextColumn::make('alt'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProductImages::route('/'),
            'create' => Pages\CreateProductImage::route('/create'),
            'edit' => Pages\EditProductImage::route('/{record}/edit'),
        ];
    }
}
