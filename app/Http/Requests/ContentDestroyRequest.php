<?php

namespace App\Http\Requests;

use App\Rules\ClassExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContentDestroyRequest extends FormRequest
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
            'content_id' => 'required',
            'content_type' => ['required', Rule::in(array_values(config('content.types'))), new ClassExists()],
            'containable' => ['required', new ClassExists()],
            'containable_id' => 'required',
        ];
    }
}
