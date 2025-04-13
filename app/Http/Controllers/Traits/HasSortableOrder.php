<?php

namespace App\Http\Controllers\Traits;

use App\Http\Requests\UpdateOrderRequest;

trait HasSortableOrder
{
    abstract protected function getModelClass(): string;

    public function updateOrder(UpdateOrderRequest $request): \Illuminate\Http\Response
    {
        $modelClass = $this->getModelClass();
        $orderData = $request->input('order');

        $ids = collect($orderData)->pluck('id');
        $existingIds = $modelClass::whereIn('id', $ids)->pluck('id');

        if ($existingIds->count() !== $ids->count()) {
            abort(404, 'Один или несколько элементов не найдены.');
        }

        foreach ($orderData as $data) {
            $modelClass::where('id', $data['id'])->update(['order' => $data['order']]);
        }

        return response()->noContent();

        /*
         * Вариант обновления с одним запросом,
         * но без использования QueryBuilder:
         *
         * $cases = '';
         * $ids = [];
         * foreach ($orderData as $data) {
         *     $cases .= "WHEN {$data['id']} THEN {$data['order']} ";
         *     $ids[] = $data['id'];
         * }
         * $idsList = implode(', ', $ids);
         * $sql = "UPDATE users SET order = CASE id $cases END WHERE id IN ($idsList)";
         * DB::statement($sql);
         *
         */
    }
}
