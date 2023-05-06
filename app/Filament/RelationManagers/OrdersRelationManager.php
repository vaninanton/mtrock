<?php

declare(strict_types=1);

namespace App\Filament\RelationManagers;

use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $modelLabel = 'Заказ';

    protected static ?string $pluralModelLabel = 'Заказы';

    protected static ?string $title = 'Заказ';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Номер заказа'),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('RUB')
                    ->label('Сумма'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Статус')
                    ->getStateUsing(fn (Order $record): string => $record->status->toLocalizedString())
                    ->color(fn (Order $record): string => $record->status->getColor()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
