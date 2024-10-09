<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PerfectTimeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PerfectTimeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PerfectTimeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\PerfectTime::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/perfect-time');
        CRUD::setEntityNameStrings('perfect time', 'perfect times');
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
            'name'=>'student_id',
            'label'=> 'الطالب',
            'attribute'=>'name',
            'type'=> 'select',
            'entity' => 'student'
        ]);
        CRUD::addColumn([
            'name'=>'day_id',
            'label'=> 'اليوم',
            'attribute'=>'name',
            'type'=> 'select',
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
            'name'=>'student_id',
            'label'=> 'الطالب',
            'attribute'=>'name',
            'type'=> 'select',
            'entity' => 'student'
        ]);
        CRUD::addField([
            'name'=>'day_id',
            'label'=> 'اليوم',
            'attribute'=>'name',
            'type'=> 'select',
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
}
