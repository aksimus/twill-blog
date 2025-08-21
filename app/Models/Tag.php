<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Tag extends Model
{
    use Translatable;

    protected $fillable = [];

    public $translatedAttributes = [
        'title',
        'description',
        'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
