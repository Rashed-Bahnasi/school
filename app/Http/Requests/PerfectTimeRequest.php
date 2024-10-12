<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfectTimeRequest extends FormRequest
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
            // 'name' => 'required|min:5|max:255'
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
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time', 
            'student_id' => 'required|', 
            'day_id'     => 'required|',
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
            'start_time.required' => 'يرجى إدخال وقت البداية',
            'start_time.date_format' => 'يجب أن يكون وقت البداية بصيغة صحيحة (ساعة:دقيقة)',
            'end_time.required' => 'يرجى إدخال وقت الإنتهاء',
            'end_time.date_format' => 'يجب أن يكون وقت النهاية بصيغة صحيحة (ساعة:دقيقة)',
            'end_time.after' => 'يجب أن يكون وقت الإنتهاء بعد وقت البداية',
            'student_id.required' => 'يرجى اختيار الطالب',
            'day_id.required' => 'يرجى اختيار اليوم',
        ];
    }
}
