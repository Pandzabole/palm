<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassControllerCreateRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'description_first' => 'required|string',
            'description_second' => 'required|string',
            'level' => 'required|string',
            'price_usd' => 'required|numeric',
            'price_eur' => 'required|numeric',
            'price_omr' => 'required|numeric',
            'price_sar' => 'required|numeric',
            'discount' => 'sometimes',
            'discount_percentage' => 'required_unless:discount,null',
            'class_category_id' =>'required|exists:class_categories,id',
            'class_sub_category_id' =>'required|exists:class_category_class_sub_category,class_sub_category_id',
            'teacher_id' =>'required|exists:teachers,id',
            'class_location' => 'required',
            'class_length' => 'required|numeric',
            'age_restriction' => 'sometimes',
            'materials' => 'sometimes',
            'image_desktop' => 'nullable|required_without:media_desktop_id|mimes:jpeg,bmp,png',
            'media_desktop_id' => 'nullable|required_without:image_desktop|exists:media,id',
            'image_mobile' => 'nullable|required_without:media_mobile_id|mimes:jpeg,bmp,png',
            'media_mobile_id' => 'nullable|required_without:image_mobile|exists:media,id',
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
            'media_id' => 'media',
            'class_category_id' =>'categories',
            'class_sub_category_id' =>'categories',
            'teacher_id' =>'teacher',
            'discount_percentage' => 'Class discount',
            'discount' => 'discount not checked'
        ];
    }
}
