<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\ParamType;
use App\Filament\Resources\ParamResource\Pages;
use App\Models\Param;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ParamResource extends Resource
{
    protected static ?string $model = Param::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-report';

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationLabel = 'Параметры';

    protected static ?string $modelLabel = 'Параметр';

    protected static ?string $pluralModelLabel = 'Параметры';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options(ParamType::toLocalizedArray())
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Тип')
                    ->getStateUsing(fn (Param $record): string => $record->type->toLocalizedString()),
                Tables\Columns\TextColumn::make('title'),
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
            'index' => Pages\ListParams::route('/'),
            'create' => Pages\CreateParam::route('/create'),
            'edit' => Pages\EditParam::route('/{record}/edit'),
        ];
    }
}
