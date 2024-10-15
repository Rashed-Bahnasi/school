<?php

namespace App\Http\Controllers\Admin;

use App\Models\Time;
use App\Http\Requests\TimeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TimeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TimeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Time::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/time');
        CRUD::setEntityNameStrings('time', 'times');
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
            'name' => 'start_time',
            'label' =>'وقت البداية',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'end_time',
            'label' => 'وقت الإنتهاء',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name'=>'teacher_id',
            'label'=> 'الاستاذ',
            'attribute'=>'name',
            'type'=> 'select2',
            'entity' => 'teacher'
        ]);
        CRUD::addColumn([
            'name'=>'day_id',
            'label'=> 'اليوم',
            'attribute'=>'name',
            'type'=> 'select2',
            'entity' => 'day'
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
        CRUD::setValidation(TimeRequest::class);

        CRUD::addField([
            'name' => 'start_time',
            'label' =>'وقت البداية',
            'type' => 'time',
        ]);
        CRUD::addField([
            'name' => 'end_time',
            'label' => 'وقت الإنتهاء',
            'type' => 'time',
        ]);
        CRUD::addField([
            'name'=>'teacher_id',
            'label'=> 'الاستاذ',
            'attribute'=>'name',
            'type'=> 'select2',
            'entity' => 'teacher'
        ]);
        CRUD::addField([
            'name'=>'day_id',
            'label'=> 'اليوم',
            'attribute'=>'name',
            'type'=> 'select2',
            'entity' => 'day'
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
    }
}
