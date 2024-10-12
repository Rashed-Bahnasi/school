<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'notes' => 'required|string',
            'courses' => 'required', // Assuming courses are linked via ID
            'start_time' => 'required|date_format:H:i', // Assuming time is in H:i format
            'end_time' => 'required|date_format:H:i|after:start_time',
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
            'name.required' => 'اسم المعلم مطلوب.',
            'start_time.required' => 'يجب إدخال وقت البداية.',
            'end_time.required' => 'يجب إدخال وقت النهاية.',
            'end_time.after' => 'يجب أن يكون وقت النهاية بعد وقت البداية.',
        ];
    }
}
