<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $fillable=[
        'cate_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
    public function orderitem()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class,'product_id');
    }
}
