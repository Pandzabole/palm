<?php

namespace App\Http\Requests;

use App\Rules\UploadImageRule;
use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
            'steps.*' => new UploadImageRule(false),
            'steps.*.cta' => 'nullable|string',
            'steps.*.url' => 'nullable|string',
            'steps.*.image_desktop' => 'nullable|mimes:jpeg,bmp,png',
            'steps.*.media_desktop_id' => 'nullable|exists:media,id',
            'steps.*.image_mobile' => 'nullable|mimes:jpeg,bmp,png',
            'steps.*.media_mobile_id' => 'nullable|exists:media,id',
            'deleted_steps.*' => 'nullable|exists:slider_items,id',
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
            'steps.*' => 'slider',
            'steps.*.cta' => 'slider cta',
            'steps.*.url' => 'slider url',
            'steps.*.image_desktop' => 'slider image desktop',
            'steps.*.image_mobile' => 'slider image mobile',
            'steps.*.media_desktop_id' => 'slider existing desktop media',
            'steps.*.media_mobile_id' => 'slider existing mobile media',
        ];
    }
}
