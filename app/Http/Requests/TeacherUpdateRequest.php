<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'gender_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'testimonials_first' => 'required',
            'testimonials_second' => 'required',
            'image' => 'nullable|mimes:jpeg,bmp,png',
            'media_id' => 'nullable|exists:media,id',
        ];

        if ($this->request->get('deleted')) {
            $rules['image'] = 'nullable|required_without:media_id|mimes:jpeg,bmp,png';
            $rules['media_id'] = 'nullable|required_without:image|exists:media,id';
        }
        return $rules;
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => 'email address',
        ];
    }
}
