<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'name'
    ];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id'); //Если используешь hasMany, то надо предпологать что под категории больше чем 1
    }

}
