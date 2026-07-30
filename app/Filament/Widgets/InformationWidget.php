<?php

namespace App\Filament\Widgets;

use App\Models\Email;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InformationWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(label: 'Correos recibidos', value: Email::query()->count())
                ->color('success'),
        ];
    }
}
