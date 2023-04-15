<?php

declare(strict_types=1);

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ProductRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Товар';

    protected static ?string $pluralModelLabel = 'Товары';

    protected static ?string $title = 'Товар';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
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
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
