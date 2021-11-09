<?php

namespace App\Http\Requests;

use App\Rules\UploadImageRule;
use Illuminate\Foundation\Http\FormRequest;

class StaticComponentsUpdateRequest extends FormRequest
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
            'components' => 'required|array',
            'components.*' => new UploadImageRule(false),
            'components.*.id' => 'required|exists:static_components,id',
            'components.*.tag' => 'nullable|string',
            'components.*.primary_title' => 'nullable|string',
            'components.*.secondary_title' => 'nullable|string',
            'components.*.sub_title' => 'nullable|string',
            'components.*.description' => 'nullable|string',
            'components.*.cta' => 'nullable|string',
            'components.*.image_desktop' => 'nullable|mimes:jpeg,bmp,png',
            'components.*.media_desktop_id' => 'nullable|exists:media,id',
            'components.*.image_mobile' => 'nullable|mimes:jpeg,bmp,png',
            'components.*.media_mobile_id' => 'nullable|exists:media,id',
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
            'components.*' => 'component',
            'components.*.image_desktop' => 'component image desktop',
            'components.*.image_mobile' => 'component image mobile',
            'components.*.media_desktop_id' => 'component existing desktop media',
            'components.*.media_mobile_id' => 'component existing mobile media',
        ];
    }
}
