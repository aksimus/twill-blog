<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\BlogAuthor;

class BlogAuthorTranslation extends Model
{
    protected $baseModuleModel = BlogAuthor::class;

    protected $casts = [
        'seo' => 'array',
    ];
}
