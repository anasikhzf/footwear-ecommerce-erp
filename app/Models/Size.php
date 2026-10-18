<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $primaryKey = 'size_id';
    public $timestamps = false;

    protected $fillable = [
        'size_value',
    ];

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'size_id', 'size_id');
    }
}
