<?php

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCallbacks extends ListRecords
{
    protected static string $resource = CallbackResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
