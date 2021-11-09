<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AdminCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'role_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8' ,
            'market_id.*' => 'exclude_if:role_id,' . User::MAIN_ADMIN. '|required|exists:main_markets,id'
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
            'role_id' => 'Select admin privileges',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $this->merge([
            'status' => $this->status ?? false,
            'password' => Hash::make($this->password),
            'password_confirmation' => Hash::make($this->password_confirmation),
        ]);
    }
}
