<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'article',
            'name',
            'status',
            'data'
        ];

    public static function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public static function addEdit($product, $id = 0): int
    {
        if ($id != 0) {
            self::where('id', $id)->update($product);
        } else {
            $product = new self($product);
            $product->save();
        }

        return isset($product->id) ? $product->id : $id;
    }

    public static function checkUniqueArticle($article, $id = 0): bool
    {
        if (empty($id))
            $check = Products::where('article', $article)->first();
        else
            $check = Products::where('article', $article)
                ->where('id', '!=', $id)
                ->first();

        return empty($check) ?? true;
    }

    protected function getStatusAttribute($value): string
    {
        if ($value == 'available')
            return 'Доступен';
        else
            return 'Не Доступен';
    }

    protected function getDataAttribute($value): array
    {
        return !empty($value) ? json_decode($value, true) : array();
    }
}
