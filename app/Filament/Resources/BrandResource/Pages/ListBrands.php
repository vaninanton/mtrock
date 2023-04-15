<?php

declare(strict_types=1);

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;

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
                'products',
                'products AS products_active' => fn (Builder $query): Builder => $query
                    ->select(
                        DB::raw('count(*) as products_active')
                    )
                    ->where('quantity', '>', 0),
                'products AS products_quantity' => fn (Builder $query): Builder => $query
                    ->select(
                        DB::raw('SUM(quantity) as products_quantity')
                    ),
            ])
            ->withoutGlobalScopes();
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [25, 50, 100];
    }
}
