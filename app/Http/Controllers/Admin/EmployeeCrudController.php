<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('employee', 'employees');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

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
        CRUD::setValidation(EmployeeRequest::class);
        CRUD::addField([
            'name' => 'name',
            'label' => 'الاسم',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'contact_number',
            'label' => 'رقم التواصل',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'email',
            'label' => 'البريد الإلكتروني',
            'type' => 'email',
        ]);
        CRUD::addField([
            'name' => 'working_hours',
            'label' => 'ساعات العمل',
            'type' => 'number',
            'suffix' => 'ساعات'
        ]);
        CRUD::addField([
            'name' => 'role',
            'type' => 'select_from_array',
            'label' => 'الدور',
            'options' => [
                'manager' => 'مدير',
                'supervisor' => 'مشرف',
                'admin_staff' => 'موظف إداري',
            ],
            'allows_null' => false,
            'default' => 'admin_staff',
        ]);

        CRUD::addField([
            'name' => 'permissions',
            'type' => 'checklist',
            'label' => 'الصلاحيات',
            'entity' => 'permissions', // العلاقة في الموديل
            'attribute' => 'name', // الحقل الذي تريد عرضه
            'model' => \Spatie\Permission\Models\Permission::class, // نموذج الصلاحيات
            'pivot' => true, // لتفعيل الجدول الوسيط
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
