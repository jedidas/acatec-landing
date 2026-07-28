<?php

namespace App\Filament\Widgets;

use App\Models\Email;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InformationWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(label: 'Productos activos', value: Product::query()->where('is_active', true)->count())
                ->color('success'),
            Stat::make(label: 'Productos inactivos', value: Product::query()->where('is_active', false)->count())
                ->color('danger'),
            Stat::make(label: 'Correos recibidos', value: Email::query()->count())
                ->color('success'),
        ];
    }
}
