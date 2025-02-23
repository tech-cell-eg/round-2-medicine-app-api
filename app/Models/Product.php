<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_details',
        'ingredients',
        'expiry_date',
        'brand_name',
        'rating',
        'sub_category_id'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
