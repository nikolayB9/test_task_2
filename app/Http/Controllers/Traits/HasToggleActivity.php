<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\ToggleActivityRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

trait HasToggleActivity
{
    abstract protected function getModelClass(): string;
    abstract protected function getRouteKey(): string;

    public function toggleActivity(ToggleActivityRequest $request): Response
    {
        $model = $this->resolveModel();

        $model->update([
            'is_active' => $request->input('is_active'),
        ]);

        return response()->noContent(); // 204
    }

    /**
     * Получает модель по route параметру (например, {article}, {category})
     */
    protected function resolveModel(): Model
    {
        $modelClass = $this->getModelClass();
        $id = Route::input($this->getRouteKey());

        return $modelClass::findOrFail($id);
    }
}
