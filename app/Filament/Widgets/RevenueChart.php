<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Revenue Bulanan';

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('M');
        });

        $revenues = collect(range(1, 12))->map(function ($month) {
            return Transaction::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->sum('grand_total_amount');
        });

        return [
            //
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $revenues->toArray(),
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
