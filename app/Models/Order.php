<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'fname',
        'lname',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'totalprice',
        'user_id',
        'status',
        'message',
        'tracking_number',
    ];

    public function orderitem()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }
}
