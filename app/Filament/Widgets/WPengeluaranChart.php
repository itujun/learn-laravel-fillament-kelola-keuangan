<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class WPengeluaranChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Pengeluaran';
    protected static string $color = 'danger';

    protected function getData(): array
    {
        $data = Trend::query(Transaction::expenses())
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
                    'label' => 'Pengeluaran per Bulan',
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
