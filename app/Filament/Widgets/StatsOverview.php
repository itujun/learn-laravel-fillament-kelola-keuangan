<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{

    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $pemasukan = Transaction::incomes()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        // format $pemasukan menjadi Rupiah
        $pemasukanFormatted = 'Rp ' . number_format($pemasukan, 0, ',', '.');

        $pengeluaran = Transaction::expenses()->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
        // format $pengeluaran menjadi Rupiah
        $pengeluaranFormatted = 'Rp ' . number_format($pengeluaran, 0, ',', '.');

        $selisih = $pemasukan - $pengeluaran;
        $selisihFormatted = 'Rp ' . number_format($selisih, 0, ',', '.');

        return [
            Stat::make('Pemasukan', $pemasukanFormatted),
            Stat::make('Pengeluaran', $pengeluaranFormatted),
            Stat::make('Selisih', $selisihFormatted),
        ];
    }
}
