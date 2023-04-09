<?php

declare(strict_types=1);

namespace App\Filament\Resources\CallbackResource\Widgets;

use App\Models\Callback;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class CallbackOverview extends LineChartWidget
{
    protected static ?string $heading = 'Количество обратных звонков';

    protected static ?string $maxHeight = '300px';

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = Trend::model(Callback::class)
            ->between(
                start: now()->subDays(90),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Обратных звонков',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
