<?php

namespace App\Http\Requests\EditorImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class DeleteImageRequest extends FormRequest
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
            'image_path' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Проверка, существует ли файл в диске "public"
                    if (!Storage::disk('public')->exists($value)) {
                        $fail('Файл не найден или уже удалён.');
                    }

                    // Защита: запрещаем выход за пределы допустимых папок
                    if (!str_starts_with($value, 'images/')) {
                        $fail('Недопустимый путь к файлу.');
                    }
                },
            ],
        ];
    }
}
