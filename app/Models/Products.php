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

    public static function addEdit($product, $id = 0)
    {
        if ($id != 0) {
            self::where('id', $id)->update($product);
        } else {
            $product = new self($product);
            $product->save();
        }

        return isset($product->id) ? $product->id : $id;
    }

    protected function getStatusAttribute($value)
    {
        if ($value == 'available')
            return 'Доступен';
        else
            return 'Не Доступен';
    }

    protected function getDataAttribute($value)
    {
        return json_decode($value, true);
    }
}
