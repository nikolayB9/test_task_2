<?php

namespace App\Http\Requests\Article;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
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
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'title')->ignore($this->article),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($this->article),
                'regex:/^[a-z\d-]+[a-z\d]+$/',
            ],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image_path' => [
                'required',
                'string',
                Rule::unique('articles', 'image_path')->ignore($this->article),
                function ($attribute, $value, $fail) {
                    // Проверка, существует ли файл в диске "public"
                    if (!Storage::disk('public')->exists($value)) {
                        $fail('Изображение не найдено или уже удалено.');
                    }
                },
            ],
            'is_active' => ['nullable', 'string', 'in:on'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $validator->errors()->add('failedValidation', true);
    }
}
