<?php

namespace Modules\Blog\Entities;

use App\Models\Admin;
use Modules\Pages\Entities\MetaData;
use Modules\Service\Entities\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['category_id',
        'admin_id', 'title', 'slug', 'blog_content',
        'image', 'status', 'views',
        'tag_name',
    ];

    protected $casts = ['status' => 'integer'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogPostFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function meta_data()
    {
        return $this->morphOne(MetaData::class, 'meta_taggable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_post_id');
    }
}
