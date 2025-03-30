<?php

namespace App\Filament\Widgets;

use App\Models\School;
use App\Models\Business;
use App\Models\SchoolAdmin;
use App\Models\BusinessAdmin;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Schools', School::count())
                ->description('All registered schools')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Total School Admins', SchoolAdmin::count())
                ->description('School administrators')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([2, 4, 6, 8, 5, 3, 7]),

            Stat::make('Total Businesses', Business::count())
                ->description('All registered businesses')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('info')
                ->chart([3, 5, 2, 8, 4, 6, 5]),

            Stat::make('Total Business Admins', BusinessAdmin::count())
                ->description('Business administrators')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([4, 7, 3, 5, 8, 2, 6]),

            Stat::make('System Users', User::count())
                ->description('Platform administrators')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('warning')
                ->chart([2, 3, 5, 4, 6, 3, 4]),
        ];
    }
}
