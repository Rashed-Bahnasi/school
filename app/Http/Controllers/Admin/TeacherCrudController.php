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
            'type' => 'select2', 
            'entity' => 'courses', 
            'attribute' => 'name', 
            'model' => 'App\Models\Course',
            'pivot' => false,
        ]);CRUD::addColumn([
            'name' => 'courses', 
            'label' => 'الكورسات', 
            'type' => 'select2', 
            'entity' => 'courses', 
            'attribute' => 'name', 
            'model' => 'App\Models\Course',
            'pivot' => false,
        ]);
        CRUD::addColumn([
            'name' => 'specializations', 
            'label' => 'التخصصات', 
            'type' => 'select2', 
            'entity' => 'specializations', 
            'attribute' => 'name', 
            'model' => 'App\Models\Specializations',
            'pivot' => false,
        ]);
        // CRUD::addColumn([
        //     'name' => 'start_time', 
        //     'label' => 'وقت البداية',
        //     'type' => 'select2',
        //     'entity' => 'times', 
        //     'attribute' => 'start_time', 
        //     'model' => 'App\Models\Time',
        //     'pivot' => false,
        // ]);
        // CRUD::addColumn([
        //     'name' => 'end_time', 
        //     'label' => 'وقت النهاية',
        //     'type' => 'select2', 
        //     'entity' => 'times', 
        //     'attribute' => 'end_time', 
        //     'model' => 'App\Models\Time',
        //     'pivot' => false,
        // ]);
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
             'type'=> 'select2',
             'entity' => 'specializations'
        ]);
        CRUD::addField([
            'name'      => 'available_times',
            'label'     => 'الاوقات المتاحة',
            'type'      => 'repeatable',
            'subfields' => [
                [
                    'name'=>'day_id',
                    'label'=> 'اليوم',
                    'attribute'=>'name',
                    'type'=> 'select2',
                    'entity' => 'day',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
                [
                    'name'    => 'start_time',
                    'type'      => 'time',
                    'label'     => 'بداية الوقت',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
                [
                    'name'    => 'end_time',
                    'type'      => 'time',
                    'label'     => 'نهاية الوقت',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
            ],
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

        CRUD::addColumn([
            'name'      => 'available_times',
            'label'     => 'الاوقات المتاحة',
            'type'      => 'repeatable',
            'subfields' => [
                [
                    'name'       => 'day_id',
                    'label'      => 'اليوم',
                    'type'       => 'select2_from_array',
                    'options'    => \App\Models\Day::pluck('name', 'id')->toArray(),
                    
                ],
                [
                    'name'    => 'start_time',
                    'label'     => 'بداية الوقت',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
                [
                    'name'    => 'end_time',
                    'label'     => 'نهاية الوقت',
                    'wrapper' => [
                        'class' => 'col-md-3',
                    ],
                ],
            ],
        ]);
    }
}
