<?php

declare(strict_types=1);

namespace App\Filament\Resources\ParamsOptionResource\Pages;

use App\Filament\Resources\ParamsOptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParamsOptions extends ListRecords
{
    protected static string $resource = ParamsOptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
