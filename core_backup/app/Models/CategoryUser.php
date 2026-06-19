<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\Category;
use Modules\Service\Entities\SubCategory;

class CategoryUser extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
