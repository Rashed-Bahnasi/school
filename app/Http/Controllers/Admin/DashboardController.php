<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function dashboard()
    {

            Widget::add(['type' => 'div', 'class' => 'row', 'content' => [
                [
                    'type'        => 'progress',
                    'class'       => 'col-sm-6 my-4',
                    'value'       => Student::count(),
                    'description' => 'عدد الطلاب',
                    'progressClass' => 'progress-bar bg-primary',
                    'hint'        => 'عدد الطلاب المسجلين.',
                ],
                [
                    'type'        => 'progress',
                    'class'       => 'col-sm-6 my-4',
                    'value'       => Teacher::count(), 
                    'description' => 'عدد الأساتذة',
                    'progressClass' => 'progress-bar bg-primary',
                    'hint'        => 'عدد الأساتذة المسجلين.',
                ],
                [
                    'type'        => 'progress',
                    'class'       => 'col-sm-6 my-4',
                    'value'       => Course::count(),
                    'description' => 'عدد الكورسات',
                    'progressClass' => 'progress-bar bg-primary',
                    'hint'        => 'عدد الكورسات المتاحة.',
                ]
        
            ],
        ]);
        Widget::add([
            'type' => 'chart',
            'controller' => \App\Http\Controllers\Admin\Charts\ChartForNewStudentChartController::class,
            'wrapper' => ['class' => 'col-12'],
        ])->to('before_content');
        return View::make('dashboard')->render();
    }
}
