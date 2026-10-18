<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    protected $table = 'billing_details';
    protected $primaryKey = 'billing_id';

    protected $fillable = [
        'user_id',
        'name',
        'phone_number',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'billing_id', 'billing_id');
    }
}
