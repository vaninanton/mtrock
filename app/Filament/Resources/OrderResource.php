<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Клиенты';

    protected static ?string $navigationLabel = 'Заказы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('delivery_id')
                    ->relationship('delivery', 'title'),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255),
                Forms\Components\TextInput::make('delivery_price'),
                Forms\Components\TextInput::make('pay_method')
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_price'),
                Forms\Components\TextInput::make('coupon_discount'),
                Forms\Components\Toggle::make('separate_delivery'),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->maxLength(255),
                Forms\Components\TextInput::make('house')
                    ->maxLength(255),
                Forms\Components\TextInput::make('apartment')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_country')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('comment')
                    ->maxLength(1000),
                Forms\Components\TextInput::make('note')
                    ->maxLength(1000),
                Forms\Components\TextInput::make('payment_link')
                    ->maxLength(1000),
                Forms\Components\TextInput::make('ip_address')
                    ->maxLength(45),
                Forms\Components\DateTimePicker::make('paid_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('name')
                    ->label('ФИО'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Статус')
                    ->getStateUsing(fn (Order $record): string => $record->status->toLocalizedString())
                    ->color(fn (Order $record): string => $record->status->getColor()),
                Tables\Columns\TextColumn::make('delivery.title')
                    ->label('Способ доставки')
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('slug')
                //     ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('pay_method')
                    ->label('Способ оплаты')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Сумма заказа')
                    ->money('RUB'),
                Tables\Columns\TextColumn::make('delivery_price')
                    ->label('Стоимость доставки')
                    ->money('RUB'),
                // Tables\Columns\TextColumn::make('coupon_discount')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\IconColumn::make('separate_delivery')
                //     ->toggleable(isToggledHiddenByDefault: true)
                //     ->boolean(),
                // Tables\Columns\TextColumn::make('country')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('city')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('street')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('house')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('apartment')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('phone')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('phone_country')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('email')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('comment')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('note')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('payment_link')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('ip_address')
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('paid_at')
                //     ->dateTime()
                //     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc')
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
