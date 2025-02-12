<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\Transaction;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class WPemasukanChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $data = Trend::query(Transaction::incomes())
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            // ->count();
            ->sum('amount');

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan per Bulan',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
