<?php

declare(strict_types=1);

namespace App\Filament\Resources\ParamsOptionResource\Pages;

use App\Filament\Resources\ParamsOptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParamsOption extends EditRecord
{
    protected static string $resource = ParamsOptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
