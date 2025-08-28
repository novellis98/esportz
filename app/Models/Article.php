<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['name', 'description', 'img', 'price', 'category_id', 'color', 'material', 'stock', 'clothing_category_id', 'person_category_id'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function clothingCategory()
    {
        return $this->belongsTo(ClothingCategory::class);
    }
    public function personCategory()
    {
        return $this->belongsTo(PersonCategory::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }
}
