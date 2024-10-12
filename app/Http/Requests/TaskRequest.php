<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'assigned_employee_id' => 'required|exists:employees,id',
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:new,in_progress,pending,completed',        ];
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
            'name.required' => 'اسم المهمة مطلوب.',
            'assigned_employee_id.required' => 'الموظف المسؤول مطلوب.',
            'due_date.required' => 'تاريخ الانتهاء مطلوب.',
            'due_date.after' => 'تاريخ الانتهاء يجب أن يكون بعد اليوم.',
            'status.required' => 'حالة المهمة مطلوبة.',
            'status.in' => 'الحالة المحددة غير صالحة.',
        ];
    }
}
