<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditorImage\DeleteImageRequest;
use App\Http\Requests\EditorImage\UploadImageRequest;
use Illuminate\Support\Facades\Storage;

class EditorImageController extends Controller
{
    public function store(UploadImageRequest $request)
    {
        $type = $request->input('type');
        $pathToSave = config('images.paths.' . $type);

        $imagePath = $request->file('image')->store($pathToSave, 'public');
        $url = '/storage/' . $imagePath;

        return response()->json([
            'image_path' => $imagePath,
            'url' => $url,
        ]);
    }

    public function destroy(DeleteImageRequest $request)
    {
        $imagePath = $request->input('image_path');

        Storage::disk('public')->delete($imagePath);

        return response()->json(['message' => 'Файл удалён']);
    }
}
