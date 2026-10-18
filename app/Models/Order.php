<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'billing_id',
        'total_amount',
        'order_status',
        'created_at',
    ];

    public function billingDetail()
    {
        return $this->belongsTo(BillingDetail::class, 'billing_id', 'billing_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
