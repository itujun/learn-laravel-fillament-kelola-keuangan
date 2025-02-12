<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Transaction::incomes()->get()->sum('amount');
        // format $pemasukan menjadi Rupiah
        $pemasukanFormatted = 'Rp ' . number_format($pemasukan, 0, ',', '.');

        $pengeluaran = Transaction::expenses()->get()->sum('amount');
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
