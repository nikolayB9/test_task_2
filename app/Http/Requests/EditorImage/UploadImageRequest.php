<?php

namespace App\Http\Requests\EditorImage;

use App\Enums\EditorImage\TypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadImageRequest extends FormRequest
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
            'image' => [
                'required',
                'image',
                'mimes:png,jpeg,webp',
                'extensions:png,jpeg,webp',
                'max:2048',
            ],
            'type' => ['required', 'string', Rule::enum(TypeEnum::class)],
        ];
    }
}
