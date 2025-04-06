<?php

namespace App\Http\Requests\User;

use App\Enums\User\RoleEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user)
            ],
            'role' => ['nullable', 'integer', Rule::enum(RoleEnum::class)],
            'is_active' => ['nullable', 'string', 'in:on'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $validator->errors()->add('failedValidation', true);
    }
}
