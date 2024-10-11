@extends(backpack_view('blank'))

@php
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;

Widget::add(['type' => 'div', 'class' => 'row', 'content' => [
    [
        'type'        => 'progress',
        'class'       => 'col-sm-6 my-4',
        'value'       => Student::count(),
        'description' => 'عدد الطلاب',
        'hint'        => 'عدد الطلاب المسجلين.',
    ],
    [
        'type'        => 'progress',
        'class'       => 'col-sm-6 my-4',
        'value'       => Teacher::count(), 
        'description' => 'عدد الأساتذة',
        'hint'        => 'عدد الأساتذة المسجلين.',
    ],
    [
        'type'        => 'progress',
        'class'       => 'col-sm-6 my-4',
        'value'       => Course::count(),
        'description' => 'عدد الكورسات',
        'hint'        => 'عدد الكورسات المتاحة.',
    ]

],
]);
@endphp

@section('content')
@endsection