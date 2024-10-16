<?php

namespace App\Http\Controllers\Admin\Charts;

use Backpack\CRUD\app\Http\Controllers\ChartController;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Student;
use Carbon\Carbon;
/**
 * Class ChartForNewStudentChartController
 * @package App\Http\Controllers\Admin\Charts
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ChartForNewStudentChartController extends ChartController
{
    public function setup()
    {
        $this->chart =  new Chart();
        
        $studentsCount = Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $this->chart->dataset('New Students', 'line', array_values($studentsCount));
        $this->chart->labels(array_keys($studentsCount));

        $this->chart->options([
            'scales' => [
                'yAxes' => [[
                    'ticks' => ['beginAtZero' => true],
                ]],
            ],
        ]);
    }
}