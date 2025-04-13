<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class)->select('id', 'title');
    }

    public function getImageUrlAttribute(): string
    {
        return url('/storage/' . $this->image_path);
    }

    public function getCreatedAtAttribute($value): string
    {
        return \Illuminate\Support\Carbon::create($value)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($value): string
    {
        return \Illuminate\Support\Carbon::create($value)->format('Y-m-d');
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

}
