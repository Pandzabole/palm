<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCreateRequest extends FormRequest
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
        return [
            'name' => 'required',
            'gender_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'education' => 'required',
            'experience' => 'required',
            'age' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'image' => 'nullable|required_without:media_id|mimes:jpeg,bmp,png',
            'media_id' => 'nullable|required_without:image|exists:media,id',
        ];
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
