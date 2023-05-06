<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $modelLabel = 'Новость';

    protected static ?string $pluralModelLabel = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название новости')
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->disabled()
                    ->required()
                    ->unique(News::class, 'slug', ignoreRecord: true),
                Forms\Components\FileUpload::make('image')
                    ->label('Фотография')
                    ->directory('news'),
                Forms\Components\Textarea::make('short_description')
                    ->label('Краткое описание')
                    ->maxLength(1000),
                Forms\Components\RichEditor::make('description')
                    ->label('Текст новости')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('products')
                    ->label('Привязать продукт')
                    ->relationship('products', 'title')
                    ->multiple()
                    ->searchable(),
                Forms\Components\TextInput::make('link')
                    ->label('Привязать ссылку')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('video')
                    ->label('Ссылка на видео')
                    ->url()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Дата создания'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
