<?php

namespace App\Http\Requests;

use App\Rules\ClassExists;
use Illuminate\Foundation\Http\FormRequest;

class ReorderContentsRequest extends FormRequest
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
            'items.*.new' => 'required|exists:contents,sort_order',
            'items.*.old' => 'required|exists:contents,sort_order',
            'containable' => ['required', new ClassExists()],
            'containable_id' => 'required',
        ];
    }
}
