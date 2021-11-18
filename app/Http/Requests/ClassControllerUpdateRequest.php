<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassControllerUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'class_category_id' =>'required|exists:class_categories,id',
            'class_sub_category_id' =>'required|exists:class_sub_categories,id',
            'teacher_id' =>'required|exists:teachers,id',
            'class_location' => 'required',
            'image_desktop' => 'nullable|mimes:jpeg,bmp,png',
            'media_desktop_id' => 'nullable|exists:media,id',
            'image_mobile' => 'nullable|mimes:jpeg,bmp,png',
            'media_mobile_id' => 'nullable|exists:media,id',
        ];

        if ($this->request->get('desktop_deleted')) {
            $rules['image_desktop'] = 'nullable|required_without:media_desktop_id|mimes:jpeg,bmp,png';
            $rules['media_desktop_id'] = 'nullable|required_without:image_desktop|exists:media,id';
        }

        if ($this->request->get('mobile_deleted')) {
            $rules['image_mobile'] = 'nullable|required_without:media_id|mimes:jpeg,bmp,png';
            $rules['media_mobile_id'] = 'nullable|required_without:image_mobile|exists:media,id';
        }

        return $rules;
    }
}
