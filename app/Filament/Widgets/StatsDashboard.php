<?php

namespace App\Filament\Widgets;

use App\Models\Faktur;
use App\Models\Barang;
use App\Models\CustomerModel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countFaktur= Faktur::count();
        $countBarang= Barang::count();
        $countCustomer= CustomerModel::count();
        return [
            Stat::make('Jumlah Faktur', $countFaktur,'Faktur'),
            Stat::make('Jumlah Barang', $countBarang,'Barang'),
            Stat::make('Jumlah Customer', $countCustomer,'Customer'),
        ];
    }
}
