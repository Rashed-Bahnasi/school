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
            'name'=>'country_id',
           'label'=> 'البلد',
           'attribute'=>'name',
           'type'=> 'select',
           'entity' => 'country'
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
            'name'=>'country_id',
            'label'=> 'البلد',
            'attribute'=>'name',
            'type'=> 'select',
            'entity' => 'country'
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
