<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('teacher', 'TeacherCrudController');
    Route::crud('course', 'CourseCrudController');
    Route::get('dashboard', 'DashboardController@dashboard')->name('backpack.dashboard');
    Route::get('course/{id}/change-status/{status}', 'CourseCrudController@changeStatus')->name('course.changeStatus');

    Route::crud('student', 'StudentCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('day', 'DayCrudController');
    Route::crud('perfect-time', 'PerfectTimeCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('employee', 'EmployeeCrudController');
    Route::crud('task', 'TaskCrudController');
    Route::crud('specialization', 'SpecializationCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
