<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ParamsOptionResource\Pages;
use App\Models\ParamsOption;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ParamsOptionResource extends Resource
{
    protected static ?string $model = ParamsOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationLabel = 'Параметры/Варианты';

    protected static ?string $modelLabel = 'Вариант';

    protected static ?string $pluralModelLabel = 'Варианты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('param_id')
                    ->relationship('param', 'title')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('param.title'),
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
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
            'index' => Pages\ListParamsOptions::route('/'),
            'create' => Pages\CreateParamsOption::route('/create'),
            'edit' => Pages\EditParamsOption::route('/{record}/edit'),
        ];
    }
}
