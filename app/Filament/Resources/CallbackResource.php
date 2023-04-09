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

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Обратный звонок';

    protected static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::whereNull('answered_at')->count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::whereNull('answered_at')->count() > 10 ? 'warning' : 'primary';
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
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\TextColumn::make('answered_at')
                    ->sortable()
                    ->dateTime('d.m.Y H:i'),
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
                Tables\Actions\Action::make('Готов')
                    ->action(function (Callback $record) {
                        $record->answered_at = now();
                        $record->save();
                    })
                    ->icon('heroicon-o-check')
                    ->disabled(function (Callback $record) {
                        return !is_null($record->answered_at);
                    })
                    ->requiresConfirmation()
                    ->color('success'),

            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
