<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,completed',
            'type' => 'required|in:public,private',
            'number_of_lessons' => 'required|integer|min:1',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'max_number_of_students' => 'required|integer|min:3',
            'min_number_of_students' => 'required|integer|min:1',
            'course_duration' => 'required|integer|min:1',
            'teacher_id' => 'required|',
            'students' => 'required|array',
            'subject_id' => 'required|',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'status.required' => 'الحالة مطلوبة.',
            'type.required' => 'النوع مطلوب.',
            'number_of_lessons.required|min:0' => 'عدد الدروس مطلوب.',
            'start_time.required' => 'وقت البدء مطلوب.',
            'end_time.required' => 'وقت الانتهاء مطلوب.',
            'end_time.after' => 'يجب أن يكون وقت الانتهاء بعد وقت البدء.',
            'max_number_of_students.required' => 'أقصى عدد طلاب ممكن مطلوب.',
            'min_number_of_students.required' => 'أقل عدد طلاب ممكن مطلوب.',
            'course_duration.required' => 'مدة الكورس مطلوبة.',
            'teacher_id.required' => 'الاستاذ مطلوب.',
            'student_id.required' => 'الطالب مطلوب.',
            'subject_id.required' => 'المادة مطلوبة.',
        ];
    }
}
