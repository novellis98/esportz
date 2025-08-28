<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['article_id', 'quantity', 'price', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
