<?php

namespace Modules\PromoteInfluencer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectPromoteSettings extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'budget', 'duration', 'status'];

    protected static function newFactory()
    {
        return \Modules\PromoteInfluencer\Database\factories\ProjectPromoteSettingsFactory::new();
    }
}
