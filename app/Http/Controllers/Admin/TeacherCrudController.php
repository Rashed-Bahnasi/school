<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TeacherCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TeacherCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Teacher::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/teacher');
        CRUD::setEntityNameStrings('teacher', 'teachers');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'name',
            'type'=> 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addColumn([
            'name' => 'notes',
            'type'=> 'textarea',
            'label' => 'ملاحظات'
        ]);
        CRUD::addColumn([
            'name' => 'courses', 
            'label' => 'الكورسات', 
            'type' => 'select', 
            'entity' => 'courses', 
            'attribute' => 'name', 
            'model' => 'App\Models\Course',
            'pivot' => false,
        ]);
        CRUD::addColumn([
            'name' => 'start_time', 
            'label' => 'وقت البداية',
            'type' => 'select', 
            'entity' => 'times', 
            'attribute' => 'start_time', 
            'model' => 'App\Models\Time',
            'pivot' => false,
        ]);
        CRUD::addColumn([
            'name' => 'end_time', 
            'label' => 'وقت النهاية',
            'type' => 'select', 
            'entity' => 'times', 
            'attribute' => 'end_time', 
            'model' => 'App\Models\Time',
            'pivot' => false,
        ]);
       

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TeacherRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type'=> 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addField([
            'name' => 'notes',
            'type'=> 'textarea',
            'label' => 'ملاحظات'
        ]);
        CRUD::addField([
            'name'=>'specialization_id',
             'label'=> 'التخصصات',
             'attribute'=>'name',
             'type'=> 'select',
             'entity' => 'specializations'
        ]);
        
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
    }
}
