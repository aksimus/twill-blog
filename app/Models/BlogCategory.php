<?php

namespace App\Models;

use A17\Twill\Models\Model;
use A17\Twill\Models\Behaviors\HasTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasTranslation;
    protected $fillable = ['published'];

    public $translatedAttributes = ['title', 'slug', 'description'];

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}

