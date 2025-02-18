<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_details',
        'ingredients',
        'expiry_date',
        'brand_name',
        'rating',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
