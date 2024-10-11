<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // تأكد من استيراد الـ Controller بشكل صحيح
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function dashboard()
    {

        if (backpack_user()->is_admin){

            $this->adminWidgets();
        }

        return View::make('dashboard')->render();
    }
    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        return redirect(backpack_url('dashboard'));
    }

    protected function adminWidgets(): void
    {
        Widget::add([
            'type'        => 'progress',
            'class'       => 'card text-white bg-primary mb-2',
            'value'       => Student::count(),
            'description' => 'عدد الطلاب',
            'progress'    => 75, 
            'hint'        => 'عدد الطلاب المسجلين.',
        ])->name('numberOfStudents')->to('before_content'); // إضافة الاسم

        Widget::add([
            'type'        => 'progress',
            'class'       => 'card text-white bg-success mb-2',
            'value'       => Teacher::count(), 
            'description' => 'عدد الأساتذة',
            'progress'    => 50,
            'hint'        => 'عدد الأساتذة المسجلين.',
        ])->name('numberOfTeachers')->to('before_content'); // إضافة الاسم

        Widget::add([
            'type'        => 'progress',
            'class'       => 'card text-white bg-info mb-2',
            'value'       => Course::count(),
            'description' => 'عدد الكورسات',
            'progress'    => 30,
            'hint'        => 'عدد الكورسات المتاحة.',
        ])->name('numberOfCourses')->to('before_content');
    }
}
