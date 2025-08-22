<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Page extends Model
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions;

    protected $fillable = [
        'published',
        'title',
        'description',
        'h1_header',
        'meta_description',
        'meta_keywords',
        'content',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'h1_header',
        'meta_description',
        'meta_keywords',
        'content',
    ];

    public $slugAttributes = [
        'title',
    ];
}
