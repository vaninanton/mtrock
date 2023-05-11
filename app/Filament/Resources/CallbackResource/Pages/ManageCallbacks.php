<?php

declare(strict_types=1);

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCallbacks extends ManageRecords
{
    protected static string $resource = CallbackResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
