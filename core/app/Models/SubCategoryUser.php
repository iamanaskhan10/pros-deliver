<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryUser extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id','user_id'];
}