<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\PayMethod;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Клиенты';

    protected static ?string $navigationLabel = 'Заказы';

    protected static ?string $modelLabel = 'Заказ';

    protected static ?string $pluralModelLabel = 'Заказы';

    protected static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', '=', OrderStatus::NEW)->count();

        return $count ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('delivery_id')
                                    ->relationship('delivery', 'title')
                                    ->label('Способ доставки')
                                    ->required()
                                    ->lazy()
                                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Ссылка на заказ')
                                    ->disabled()
                                    ->required()
                                    ->unique(Order::class, 'slug', ignoreRecord: true),
                            ]),

                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->label('Статус заказа')
                                    ->options(OrderStatus::toLocalizedArray()),
                                Forms\Components\Select::make('pay_method')
                                    ->label('Метод оплаты')
                                    ->options(PayMethod::toLocalizedArray()),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('total_price')
                                    ->numeric()
                                    ->label('Стоимость заказа'),
                                Forms\Components\TextInput::make('coupon_discount')
                                    ->numeric()
                                    ->label('Скидка по купону'),
                                Forms\Components\TextInput::make('delivery_price')
                                    ->numeric()
                                    ->label('Стоимость доставки'),
                                Forms\Components\Toggle::make('separate_delivery')
                                    ->label('Доставка оплачивается отдельно'),
                            ]),
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_country')
                            ->tel()
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
                        Forms\Components\TextInput::make('comment')
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('note')
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('payment_link')
                            ->maxLength(1000),
                        Forms\Components\TextInput::make('ip_address')
                            ->maxLength(45),
                        Forms\Components\DateTimePicker::make('paid_at'),
                    ])
                    ->columnSpan(['lg' => fn (?Order $record) => $record === null ? 3 : 2]),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Создан:')
                            ->content(fn (Order $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Обновлен:')
                            ->content(fn (Order $record): ?string => $record->updated_at?->diffForHumans()),
                        Forms\Components\Placeholder::make('paid_at')
                            ->label('Оплачен:')
                            ->content(fn (Order $record): ?string => $record->paid_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Order $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Клиент'),
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
                    ->dateTime(),
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
