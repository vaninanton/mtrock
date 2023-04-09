<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationLabel = 'Категории';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'title'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('image')
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta_description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('position'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent.title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('short_description'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('meta_title'),
                Tables\Columns\TextColumn::make('meta_description'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
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
