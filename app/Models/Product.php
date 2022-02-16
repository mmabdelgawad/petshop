<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'metadata' => 'array'
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_uuid', 'uuid');
    }

    // Scopes
    public function scopeSearch($query, Request $request) {
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        if ($request->filled('price')) {
            $query->where('price', '<=', $request->get('price'));
        }

        if ($request->filled('brand')) {
            $brandUuid = Brand::query()->where('slug', $request->get('brand'))->value('uuid');
            $query->whereJsonContains('metadata->brand', $brandUuid);
        }

        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%'.$request->get('title').'%');
        }

        if ($request->filled('sort') && in_array($request->get('sort'), ['desc', 'asc'])) {
            $query->orderBy('price', $request->get('sort'));
        }

        if ($request->filled('limit')) {
            $result = $query->paginate($request->get('limit') > 20 ? 10 : $request->get('limit'));
        } else {
            $result = $query->paginate(10);
        }

        return $result;
    }
}
