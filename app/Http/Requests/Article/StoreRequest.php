<?php

namespace App\Http\Requests\Article;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'title' => ['required', 'string', 'max:255', 'unique:articles,title'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:articles,slug',
                'regex:/^[a-z\d-]+[a-z\d]+$/',
            ],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image_path' => [
                'required',
                'string',
                'unique:articles,image_path',
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

    public function prepareDataForCreation(): array
    {
        $data = $this->validated();

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['is_active'] = !empty($data['is_active']);
        $data['order'] = (\App\Models\Article::max('order') ?? 0) + 1;

        return $data;
    }
}
