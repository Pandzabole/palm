<?php

namespace App\Http\Requests;

use App\Rules\ClassExists;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use function app;

class ContentUpdateRequest extends FormRequest
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
            'content_type_class' => ['required', Rule::in(array_values(config('content.types'))), new ClassExists()],
        ];

        $content = request('content_type_class');
        if ($content && class_exists($content)) {
            $contentModel = app($content);
            $rules = array_merge($rules, $contentModel->rules);
        }

        return $rules;
    }
}
