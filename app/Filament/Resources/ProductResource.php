<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title'),
                Forms\Components\Select::make('brand_id')
                    ->relationship('brand', 'title'),
                Forms\Components\Select::make('type_id')
                    ->relationship('type', 'title'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sku')
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required(),
                Forms\Components\Toggle::make('in_stock')
                    ->required(),
                Forms\Components\Toggle::make('availability_preorder')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required(),
                Forms\Components\TextInput::make('old_price'),
                Forms\Components\TextInput::make('type_prefix')
                    ->maxLength(255),
                Forms\Components\TextInput::make('model')
                    ->maxLength(255),
                Forms\Components\TextInput::make('image')
                    ->maxLength(255),
                Forms\Components\TextInput::make('short_description')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('sales_notes')
                    ->maxLength(255),
                Forms\Components\TextInput::make('video1')
                    ->maxLength(255),
                Forms\Components\TextInput::make('video2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('video3')
                    ->maxLength(255),
                Forms\Components\Toggle::make('flag_special')
                    ->required(),
                Forms\Components\Toggle::make('flag_new')
                    ->required(),
                Forms\Components\Toggle::make('flag_hit')
                    ->required(),
                Forms\Components\TextInput::make('length'),
                Forms\Components\TextInput::make('width'),
                Forms\Components\TextInput::make('height'),
                Forms\Components\TextInput::make('weight'),
                Forms\Components\TextInput::make('position')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title'),
                Tables\Columns\TextColumn::make('brand.title'),
                Tables\Columns\TextColumn::make('type.title'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('sku'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\IconColumn::make('in_stock')
                    ->boolean(),
                Tables\Columns\IconColumn::make('availability_preorder')
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('old_price'),
                Tables\Columns\TextColumn::make('type_prefix'),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('short_description'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('sales_notes'),
                Tables\Columns\TextColumn::make('video1'),
                Tables\Columns\TextColumn::make('video2'),
                Tables\Columns\TextColumn::make('video3'),
                Tables\Columns\IconColumn::make('flag_special')
                    ->boolean(),
                Tables\Columns\IconColumn::make('flag_new')
                    ->boolean(),
                Tables\Columns\IconColumn::make('flag_hit')
                    ->boolean(),
                Tables\Columns\TextColumn::make('length'),
                Tables\Columns\TextColumn::make('width'),
                Tables\Columns\TextColumn::make('height'),
                Tables\Columns\TextColumn::make('weight'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
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
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
