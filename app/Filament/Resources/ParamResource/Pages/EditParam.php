<?php

declare(strict_types=1);

namespace App\Filament\Resources\ParamResource\Pages;

use App\Filament\Resources\ParamResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParam extends EditRecord
{
    protected static string $resource = ParamResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
