<?php

declare(strict_types=1);

namespace App\Filament\Resources\CallbackResource\Pages;

use App\Filament\Resources\CallbackResource;
use App\Filament\Resources\CallbackResource\Widgets\CallbackOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallbacks extends ListRecords
{
    protected static string $resource = CallbackResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 1;
    }

    public function getHeaderWidgets(): array
    {
        return [
            CallbackOverview::class,
        ];
    }
}
