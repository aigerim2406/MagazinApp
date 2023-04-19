<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'image', 'category_id', 'user_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo( User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function usersBought(){
        return $this->belongsToMany(User::class, 'shop_user')
            ->withPivot('number', 'material', 'size', 'status')
            ->withTimestamps()
            ->using(Cart::class);
    }


}
