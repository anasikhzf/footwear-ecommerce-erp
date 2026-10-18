<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id',
        'product_name',
        'product_price',
        'product_image',
        'product_description',
        'product_status',
    ];

    protected $casts = [
        'product_status' => 'boolean',
        'product_price' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'product_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id')
                    ->withPivot('stock', 'product_size_id');
    }
}
