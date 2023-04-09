<?php

declare(strict_types=1);

namespace App\Filament\Resources\TypeResource\Pages;

use App\Filament\Resources\TypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTypes extends ManageRecords
{
    protected static string $resource = TypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
