<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'password',
        'is_active',
        'role_id',
        'image',
        'shot',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shops(){
        return $this->hasMany( Shop::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function shopsBought(){
        return $this->belongsToMany(Shop::class, 'shop_user')
            ->withPivot('number', 'material', 'size', 'status')
            ->withTimestamps()
            ->using(Cart::class);
    }

    public function shopsWithStatus($status){
        return $this->belongsToMany(Shop::class, 'shop_user')
            ->wherePivot('status', $status)
            ->withTimestamps()
            ->withPivot('number', 'material', 'size', 'status');
    }

}
