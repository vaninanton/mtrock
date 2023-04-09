<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Callback;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Flowframe\Trend\Trend;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $orderData = Trend::model(Order::class)
            ->between(
                start: now()->subDays(90),
                end: now(),
            )
            ->perDay()
            ->count();

        $callbackData = Trend::model(Callback::class)
            ->between(
                start: now()->subDays(90),
                end: now(),
            )
            ->perDay()
            ->count();

        $sumOrder = Order::query()
            ->where('paid_at')
            ->sum('total_price');

        $countOrder = Order::query()
            ->where('paid_at')
            ->count();

        $avgOrder = 0;
        if ($countOrder > 0) {
            $avgOrder = number_format($sumOrder / $countOrder, 0, '', ' ') . ' ₽';
        }

        return [
            Card::make('Количество заказов', Order::count())
                ->chart($orderData->pluck('aggregate')->toArray())
                ->chartColor('warning'),
            Card::make('Обратный звонок', Callback::count())
                ->chart($callbackData->pluck('aggregate')->toArray())
                ->chartColor('success'),
            Card::make('Средний чек', $avgOrder),
        ];
    }
}
