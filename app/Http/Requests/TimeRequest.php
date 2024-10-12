<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
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
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'teacher_id' => 'required|',
            'day_id' => 'required|',
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
            'start_time.required' => 'يجب إدخال وقت البداية.',
            'end_time.required' => 'يجب إدخال وقت الإنتهاء.',
            'end_time.after' => 'يجب أن يكون وقت الإنتهاء بعد وقت البداية.',
            'teacher_id.required' => 'يجب اختيار الاستاذ.',
            'day_id.required' => 'يجب اختيار اليوم.',        
        ];
    }
}
