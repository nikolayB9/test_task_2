<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = false;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Illuminate\Support\Carbon::create($value)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return \Illuminate\Support\Carbon::create($value)->format('Y-m-d');
    }
}
