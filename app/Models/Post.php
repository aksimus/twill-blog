<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Post extends Model
{
    use Translatable;

    protected $fillable = [
        'category_id',
        'published',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
