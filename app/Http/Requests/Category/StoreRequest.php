<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:categories,title'],
            'is_active' => ['nullable', 'string', 'in:on'],
        ];
    }

    public function prepareDataForCreation(): array
    {
        $data = $this->validated();

        $data['is_active'] = !empty($data['is_active']);
        $data['order'] = (\App\Models\Category::max('order') ?? 0) + 1;

        return $data;
    }

    protected function failedValidation(Validator $validator): void
    {
        $validator->errors()->add('failedValidation', true);
    }
}
