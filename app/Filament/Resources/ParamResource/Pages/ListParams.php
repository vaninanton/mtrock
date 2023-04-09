<?php

namespace App\Filament\Resources\ParamResource\Pages;

use App\Filament\Resources\ParamResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParams extends ListRecords
{
    protected static string $resource = ParamResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
