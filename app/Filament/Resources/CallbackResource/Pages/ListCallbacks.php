<?php

declare(strict_types=1);

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use App\Filament\Resources\CallbackResource\Widgets\CallbackOverview;
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

    protected function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CallbackOverview::class,
        ];
    }
}
