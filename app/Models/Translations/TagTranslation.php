<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\Tag;

class TagTranslation extends Model
{
    protected $baseModuleModel = Tag::class;
}
