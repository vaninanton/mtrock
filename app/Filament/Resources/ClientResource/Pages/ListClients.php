<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClientResource\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\ClientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function isTableSearchable(): bool
    {
        return true;
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->withCount([
                'orders',
                'callbacks',
                'orders AS orders_success_count' => fn (Builder $query): Builder => $query
                    ->select(
                        DB::raw('count(*) as orders_success_count')
                    )
                    ->whereIn('status', OrderStatus::onlySuccess()),
                'orders AS orders_success_sum' => fn (Builder $query): Builder => $query
                    ->select(
                        DB::raw('SUM(total_price) as orders_success_sum')
                    )
                    ->whereIn('status', OrderStatus::onlySuccess()),
            ])
            ->withoutGlobalScopes();
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [25, 50, 100];
    }
}
