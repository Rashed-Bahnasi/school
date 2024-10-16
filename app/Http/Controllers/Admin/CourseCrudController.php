<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Student;
use App\Models\Course;
use Prologue\Alerts\Facades\Alert;


/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
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
        $this->crud->setModel(\App\Models\Course::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/course');
        $this->crud->setEntityNameStrings('course', 'courses');
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
                'label' => 'حالة الكورس',
            ],
            Course::STATUS,
            function ($value) {
                CRUD::addClause('where', 'status', $value);
            }
        );
    }

    protected function setupListOperation()
    {
        $this->addStatusFilter();
        CRUD::addButtonFromView('line', 'status', 'course_status', 'end');
        CRUD::addColumn([
            'name' => 'name',
            'type' => 'text',
            'label' => 'الاسم'
        ]);
        CRUD::addColumn([
            'name' => 'type',
            'type' => 'text',
            'label' => 'النوع'
        ]);
        CRUD::addColumn([
            'name' => 'number_of_lessons',
            'type' => 'text',
            'label' => 'عدد جلسات الكورس'
        ]);
        CRUD::addColumn([
            'name' => 'start_time',
            'type' => 'text',
            'label' => 'وقت البدء'
        ]);
        CRUD::addColumn([
            'name' => 'end_time',
            'type' => 'text',
            'label' => 'وقت الانتهاء'
        ]);
        CRUD::addColumn([
            'name' => 'max_number_of_students',
            'type' => 'text',
            'label' => 'اكثر عدد طلاب ممكن'
        ]);
        CRUD::addColumn([
            'name' => 'min_number_of_students',
            'type' => 'text',
            'label' => 'اقل عدد طلاب ممكن'
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'type' => 'closure',
            'label' => 'الحالة',
            'options' => Course::STATUS,
            'function' => function ($entry) {
                switch ($entry->status) {
                    case 'active':
                        return '<i class="bi bi-check-circle-fill text-success" title="نشط"></i>';
                    case 'completed':
                        return '<i class="bi bi-slash-circle text-secondary" title="غير نشط"></i>';
                    case 'inactive':
                        return '<i class="bi bi-hourglass-split text-info" title="مكتمل"></i>';
                    default:
                        return '<i class="bi bi-question-circle-fill text-dark" title="غير معروف"></i>';
                }
            },
            'escaped' => false,
        ]);
        CRUD::addColumn([
            'name' => 'course_duration',
            'type' => 'text',
            'label' => 'مدة الكورس'
        ]);
        CRUD::addColumn([
            'name' => 'teacher_id',
            'label' => 'الاستاذ',
            'attribute' => 'name',
            'type' => 'select2',
            'entity' => 'teacher'
        ]);
        CRUD::addColumn([
            'name' => 'student_id',
            'label' => 'الطلاب',
            'attribute' => 'name',
            'type' => 'select2',
            'entity' => 'students'
        ]);
        CRUD::addColumn([
            'name' => 'subject_id',
            'label' => 'المادة',
            'attribute' => 'name',
            'type' => 'select2',
            'entity' => 'subject'
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
        CRUD::setValidation(CourseRequest::class);
        CRUD::addField([
            'name' => 'whatsapp_group',
            'label' => 'مجموعة واتساب',
            'type' => 'switch'
        ]);
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'الاسم'
        ]);
        $this->crud->addField([
            'name' => 'status',
            'label' => 'الحالة',
            'type' => 'select_from_array',
            'options' => [
                'active' => 'فعال',
                'inactive' => 'متوقف',
                'completed' => 'منتهي',
            ],
            'allows_null' => false,
            'default' => 'active',
        ]);
        $this->crud->addField([
            'name' => 'type',
            'label' => 'النوع',
            'type' => 'select_from_array',
            'options' => [
                'public' => 'عام',
                'private' => 'خاص',
            ],
            'allows_null' => false,
            'default' => 'public',
        ]);
        CRUD::addField([
            'name' => 'number_of_lessons',
            'type' => 'number',
            'label' => 'عدد الدروس',
            'attributes' => [
                'min' => 1,
            ],
        ]);
        CRUD::addField([
            'name' => 'start_time',
            'type' => 'date',
            'label' => 'وقت البدء'
        ]);
        CRUD::addField([
            'name' => 'end_time',
            'type' => 'date',
            'label' => 'وقت الانتهاء'
        ]);
        CRUD::addField([
            'name' => 'max_number_of_students',
            'type' => 'number',
            'label' => 'أقصى عدد طلاب ممكن',
            'attributes' => [
                'min' => 3,
                'step' => 1,
            ],
            'suffix' => 'طلاب',
        ]);

        CRUD::addField([
            'name' => 'min_number_of_students',
            'type' => 'number',
            'label' => 'أقل عدد طلاب ممكن',
            'attributes' => [
                'min' => 1,
                'step' => 1,
            ],
            'suffix' => 'طلاب',
        ]);
        $this->crud->addField([
            'name' => 'course_duration',
            'label' => 'مدة الكورس',
            'type' => 'number',
            'attributes' => [
                'min' => 1,
                'step' => 1,
            ],
            'suffix' => 'minuets',
        ]);
        CRUD::addField([
            'name' => 'teacher_id',
            'label' => 'الاستاذ',
            'attribute' => 'name',
            'type' => 'select2',
            'entity' => 'teacher'
        ]);
        CRUD::addField([
            'name' => 'students',
            'label' => 'الطلاب',
            'type' => 'select2_multiple',
            'entity' => 'students',
            'attribute' => 'name',
            'model' => Student::class,
            'pivot' => true,
        ]);
        CRUD::addField([
            'name' => 'subject_id',
            'label' => 'المادة',
            'attribute' => 'name',
            'type' => 'select2',
            'entity' => 'subject'
        ]);
    }
    public function changeStatus($id, $status)
    {
        $course = Course::findOrFail($id);
        $course->status = $status;
        $course->save();

        Alert::success('تم تغيير الحالة بنجاح')->flash();
        return redirect()->back();
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
