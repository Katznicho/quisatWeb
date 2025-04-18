<?php

namespace App\Filament\School\Widgets;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Guardian;
use App\Models\SchoolDocument;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $schoolId = auth('school')->user()->school_id;

        return [
            Stat::make('Total Students', Student::where('school_id', $schoolId)->count())
                ->description('All registered students')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Total Teachers', Teacher::where('school_id', $schoolId)->count())
                ->description('Active teachers')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Guardians', Guardian::where('school_id', $schoolId)->count())
                ->description('Registered guardians')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make('Documents', SchoolDocument::where('school_id', $schoolId)->count())
                ->description('Uploaded documents')
                ->descriptionIcon('heroicon-m-document')
                ->color('primary'),
        ];
    }
}