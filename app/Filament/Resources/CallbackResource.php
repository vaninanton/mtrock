<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\Pages;
use App\Models\Callback;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class CallbackResource extends Resource
{
    protected static ?string $model = Callback::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone-outgoing';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Клиенты';

    protected static ?string $navigationLabel = 'Обратный звонок';

    protected static ?string $modelLabel = 'Обратный звонок';

    protected static ?string $pluralModelLabel = 'Обратные звонки';

    protected static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::whereNull('answered_at')->count();

        return $count ? (string) $count : null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('timezone')
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Textarea::make('comment')
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('answered_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('answered_at')
                    ->sortable()
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
                    // ->disabled(fn (Callback $record) => !is_null($record->answered_at))
                    ->requiresConfirmation(fn (Callback $record) => !is_null($record->answered_at)),
                // ->color('success'),

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
            'index' => Pages\ListCallbacks::route('/'),
            'create' => Pages\CreateCallback::route('/create'),
            'edit' => Pages\EditCallback::route('/{record}/edit'),
        ];
    }
}
