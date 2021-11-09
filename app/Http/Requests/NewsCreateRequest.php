<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCreateRequest extends FormRequest
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
            'title' => 'required|unique:news,title',
            'description' => 'required',
            'image' => 'nullable|required_without:media_id|mimes:jpeg,bmp,png',
            'media_id' => 'nullable|required_without:image|exists:media,id',
            'categories' => 'required',
            'categories.*' => 'required|exists:news_categories,id'
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
        ];
    }
}
