<?php

namespace App\Models;

use A17\Twill\Models\Model;

class BlogTagTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'description'];
}

