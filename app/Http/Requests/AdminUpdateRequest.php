<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AdminUpdateRequest extends FormRequest
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
        $admin = User::find($this->admin);

        return [
            'name' => 'required|string',
            'email' => ['required', Rule::unique('users')->ignore($admin)],
            'role_id' => 'required',
            'main_market_id.*' => 'required|exists:main_markets,id',
            'password' => 'exclude_unless:change_password,' . User::MAIN_ADMIN. '|required|string|min:8|confirmed',
            'status' => 'nullable'
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
}
