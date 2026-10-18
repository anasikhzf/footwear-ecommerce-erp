<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    protected $table = 'stock_requests';
    protected $primaryKey = 'request_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'size_id',
        'requested_quantity',
        'status',
        'request_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    public function transaction()
    {
        return $this->hasOne(SupplierTransaction::class, 'request_id', 'request_id');
    }
}
