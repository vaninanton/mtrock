<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\Pages;
use App\Filament\Resources\CallbackResource\RelationManagers\ProductsRelationManager;
use App\Models\Callback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CallbackResource extends Resource
{
    protected static ?string $model = Callback::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-arrow-up-right';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Клиенты';

    protected static ?string $navigationLabel = 'Обратный звонок';

    protected static ?string $modelLabel = 'Обратный звонок';

    protected static ?string $pluralModelLabel = 'Обратные звонки';

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::whereNull('answered_at')->count();

        return $count ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->label('Клиент')
                    ->lazy()
                    ->searchable()
                    ->relationship('client', 'name'),
                Forms\Components\TextInput::make('name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Телефон')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('timezone')
                    ->label('Часовой пояс')
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->label('Ссылка')
                    ->url()
                    ->maxLength(1000),
                Forms\Components\DateTimePicker::make('answered_at'),
                Forms\Components\Textarea::make('comment')
                    ->label('Комментарий')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('products_count')
                    ->label('Просмотрено')
                    ->counts('products'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\Filter::make('Просмотренные')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('answered_at')),
                Tables\Filters\Filter::make('Новые')
                    ->query(fn (Builder $query): Builder => $query->whereNull('answered_at')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Прочитано')
                    ->action(function (Callback $record) {
                        $record->answered_at = $record->answered_at ? null : now();
                        $record->save();
                    })
                    ->icon('heroicon-o-check')
                    ->disabled(fn (Callback $record) => !is_null($record->answered_at))
                    ->requiresConfirmation(fn (Callback $record) => !is_null($record->answered_at)),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                BulkAction::make('answer')
                    ->action(fn (Collection $records) => $records->each->answer())
                    ->deselectRecordsAfterCompletion(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCallbacks::route('/'),
            'create' => Pages\CreateCallback::route('/create'),
            'edit' => Pages\EditCallback::route('/{record}/edit'),
        ];
    }
}
