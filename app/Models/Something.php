<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Something extends Model
{
    use HasFactory;

    protected $table = "somethings";
    protected $fillable = [
        'name',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsToMany(SubCategory::class, 'something_has_subcategory', 'something_id', 'subcategory_id');
    }
}
