<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Admins', User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->count())
                ->icon(Heroicon::OutlinedUserGroup),

            Stat::make('Total Mentors', User::whereHas('roles', fn($q) => $q->where('name', 'mentor'))->count())
                ->icon(Heroicon::OutlinedAcademicCap),

            Stat::make('Total Students', User::whereHas('roles', fn($q) => $q->where('name', 'student'))->count())
                ->icon(Heroicon::OutlinedUser),

            Stat::make('Total Courses', Course::count())
                ->icon(Heroicon::OutlinedBookOpen),

            Stat::make('Total Transactions', Transaction::count())
                ->icon(Heroicon::OutlinedCreditCard),

            Stat::make('Revenue', 'Rp ' . number_format(Transaction::sum('grand_total_amount')))
                ->icon(Heroicon::OutlinedCurrencyDollar)
                ->description('Total Pendapatan Kotor')
                ->color('success'),
        ];
    }
}
