<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CallbackResource\Pages;
use App\Filament\Resources\CallbackResource\RelationManagers;
use App\Models\Callback;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CallbackResource extends Resource
{
    protected static ?string $model = Callback::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Обратный звонок';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest('id');
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('comment')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->dateTime('d.m.Y H:i'),
                Tables\Columns\TextColumn::make('answered_at')
                    ->dateTime()
                    ->dateTime('d.m.Y H:i'),
            ])
            ->filters([
                Tables\Filters\Filter::make('Просмотренные')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('answered_at')),
                Tables\Filters\Filter::make('Новые')
                    ->query(fn (Builder $query): Builder => $query->whereNull('answered_at')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
