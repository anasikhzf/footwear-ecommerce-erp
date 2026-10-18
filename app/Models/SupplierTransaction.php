<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierTransaction extends Model
{
    protected $table = 'supplier_transactions';
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'product_id',
        'size_id',
        'quantity_supplied',
        'transaction_date',
    ];

    public function stockRequest()
    {
        return $this->belongsTo(StockRequest::class, 'request_id', 'request_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
}
