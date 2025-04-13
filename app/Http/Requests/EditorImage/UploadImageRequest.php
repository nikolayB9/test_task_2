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
        $extensions = config('images.allowed_extensions');
        $maxSize = config('images.max_upload_size');

        return [
            'image' => [
                'required',
                'image',
                'mimes:' . implode(',', $extensions),
                'extensions:' . implode(',', $extensions),
                'max:' . $maxSize,
            ],
            'type' => ['required', 'string', Rule::in(array_keys(config('images.paths')))],
        ];
    }
}
