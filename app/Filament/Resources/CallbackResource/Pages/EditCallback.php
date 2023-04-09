<?php

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCallback extends EditRecord
{
    protected static string $resource = CallbackResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
