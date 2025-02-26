<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $casts = ['sizes' => 'array'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'old_price',
        'sizes',
        'product_details',
        'ingredients',
        'expiry_date',
        'brand_name',
        'rating',
        'rating_count',
        'review_count',
        'image',
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
