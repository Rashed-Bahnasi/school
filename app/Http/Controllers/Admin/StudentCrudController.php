<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); 
        CRUD::addColumn([
            'name' => 'id',
            'type'=> 'text',
            'label' => '#'
        ]);
        CRUD::addColumn([
            'name' => 'name',
            'type'=> 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addColumn([
            'name' => 'phone',
            'type'=> 'text',
            'label' => 'رقم الهاتف'
        ]);
        CRUD::addColumn([
            'name' => 'age',
            'type'=> 'text',
            'label' => 'العمر'
        ]);
        CRUD::addColumn([
            'name' => 'status',
            'type'=> 'text',
            'label' => 'الحالة'
        ]);
        // z
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);
        // CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'name' => 'name',
            'type'=> 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addField([
            'name' => 'phone',
            'type'=> 'number',
            'label' => 'رقم الهاتف'
        ]);
        CRUD::addField([
            'name' => 'age',
            'type'=> 'text',
            'label' => 'العمر'
        ]);
        CRUD::addField([
            'name' => 'status',
            'label' => 'حالة الطالب',
            'type' => 'select_from_array',
            'options' => [
                'active' => 'نشط',
                'potential' => 'محتمل',
                'inactive' => 'غير نشط',
                'withdrawn' => 'منسحب',
            ],
            'allows_null' => false, 
            'default' => 'inactive',
        ]);
        // CRUD::addField([
        //     'name' => 'country',
        //     'type'=> 'text',
        //     'label' => 'البلد'
        // ]);
        // CRUD::addField([
        //     'name' => 'preferred_days',
        //     'label' => 'الأيام المفضلة',
        //     'type' => 'select_from_array',
        //     'options' => [
        //         'sunday' => 'الأحد',
        //         'monday' => 'الإثنين',
        //         'tuesday' => 'الثلاثاء',
        //         'wednesday' => 'الأربعاء',
        //         'thursday' => 'الخميس',
        //         'friday' => 'الجمعة',
        //         'saturday' => 'السبت'
        //     ],
        //     'store_in' => 'preferred_days', 
        // ]);
        // CRUD::addField([
        //     'name' => 'preferred_times',
        //     'label' => 'الأوقات المفضلة',
        //     'type' => 'select_from_array',
        //     'options' => [
        //         'morning' => 'الصباح',
        //         'afternoon' => 'بعد الظهر',
        //         'evening' => 'المساء'
        //     ],
        //     'store_in' => 'preferred_times',
        // ]);

        // CRUD::addField([
        //     'name' => 'preferred_courses',
        //     'label' => 'الكورسات المفضلة',
        //     'type' => 'select_from_array',
        //     'options' => [
        //         'math' => 'الرياضيات',
        //         'science' => 'العلوم',
        //         'history' => 'التاريخ',
        //     ],
        //     'store_in' => 'preferred_courses', 
        // ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
