<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

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

    protected function addStatusFilter()
    {
        CRUD::addFilter(
            [
                'name'  => 'status_filter',
                'type'  => 'dropdown',
                'label' => 'حالة الطالب',
            ],
            Student::STATUS,
            function ($value) {
                CRUD::addClause('where', 'status', $value);
            }
        );
    }

    protected function setupListOperation()
    {

        $this->addStatusFilter();
        CRUD::addColumn([
            'name' => 'id',
            'type' => 'text',
            'label' => '#'
        ]);
        CRUD::addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addColumn([
            'name' => 'phone',
            'type' => 'text',
            'label' => 'رقم الهاتف'
        ]);
        CRUD::addColumn([
            'name' => 'age',
            'type' => 'text',
            'label' => 'العمر'
        ]);
        CRUD::addColumn([
            'name' => 'country_id',
            'label' => 'البلد',
            'attribute' => 'name',
            'type' => 'select',
            'entity' => 'country'
        ]);
        // CRUD::column([
        //     'name' => 'status',
        //     'wrapper' => ['class' => function ($crud, $column, $entry) {
        //         return match ($entry->status) {
        //             "active" => "badge bg-succuss",
        //             "potential" => "badge bg-warning",
        //             "inactive" => "badge bg-secondary",
        //             "withdrawn" => "badge bg-danger",
        //         };
        //     }]
        // ]);

        CRUD::addColumn([
            'name' => 'status',
            'type' => 'closure',
            'label' => 'الحالة',
            'function' => function ($entry) {
                switch ($entry->status) {
                    case 'active':
                        return '<span class="badge badge-success">نشط</span>';
                    case 'potential':
                        return '<span class="badge badge-warning">محتمل</span>';
                    case 'inactive':
                        return '<span class="badge badge-secondary">غير نشط</span>';
                    case 'withdrawn':
                        return '<span class="badge badge-danger">منسحب</span>';
                    default:
                        return '<span class="badge badge-dark">غير معروف</span>';
                }
            },
            'escaped' => false, // Important to allow HTML
        ]);
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
        Widget::add()->type('script')->content('assets/js/admin/forms/student.js');
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addField([
            'name' => 'phone',
            'type' => 'phone',
            'label' => 'رقم الهاتف'
        ]);
        CRUD::addField([
            'name' => 'age',
            'type' => 'text',
            'label' => 'العمر'
        ]);
        // CRUD::addField('country')->label('البلد');
        CRUD::addField([
            'name' => 'country_id',
            'label' => 'البلد',
            'attribute' => 'name',
            'type' => 'select',
            'entity' => 'country'
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'حالة الطالب',
            'type' => 'select_from_array',
            'options' => Student::STATUS,
            'allows_null' => false,
            'default' => 'active',
        ]);
        CRUD::addField([
            'name' => 'stop_date',
            'label' => 'تاريخ التوقف',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'stop_reason',
            'label' => 'سبب التوقف',
            'type' => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addField([
            'name' => 'expected_return_date',
            'label' => 'تاريخ العودة المتوقع',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
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
    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->crud->addColumn([
            'name' => 'courses',
            'label' => 'الكورسات',
            'type' => 'select',
            'entity' => 'courses',
            'attribute' => 'name',
            'model' => 'App\Models\Course',
            'pivot' => false,
        ]);
        CRUD::addColumn([
            'name' => 'stop_date',
            'label' => 'تاريخ التوقف',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addColumn([
            'name' => 'stop_reason',
            'label' => 'سبب التوقف',
            'type' => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        CRUD::addColumn([
            'name' => 'expected_return_date',
            'label' => 'تاريخ العودة المتوقع',
            'type' => 'date',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);
    }
}
