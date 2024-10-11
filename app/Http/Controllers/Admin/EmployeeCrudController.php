<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

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
        //CRUD::setFromDb();
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'الاسم',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'contact_number',
            'label' => 'رقم التواصل',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'email',
            'label' => 'البريد الإلكتروني',
            'type' => 'email',
        ]);
        CRUD::addColumn([
            'name' => 'working_hours',
            'label' => 'ساعات العمل',
            'type' => 'number',
            'suffix' => 'ساعات'
        ]);
        CRUD::addColumn([
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

        CRUD::addColumn([
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
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);
        $request = $this->crud->getRequest();

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
            'name' => 'password',
            'label' => 'كلمة المرور',
            'type' => 'password',
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
        
        if ($request->has('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        }
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
        $request = $this->crud->getRequest();
        if ($request->has('password') && $request->input('password') !== '') {
            // تشفير كلمة المرور فقط إذا تم إدخال كلمة مرور جديدة
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            // إزالة كلمة المرور من الطلب إذا لم يتم إدخال كلمة مرور جديدة
            $request->request->remove('password');
        }    }
}
