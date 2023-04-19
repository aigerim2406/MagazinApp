<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'category_id', 'lang', 'name_kz', 'name_ru', 'name_en'];

    public function shops(){
        return $this->hasMany(Shop::class);
    }
}
