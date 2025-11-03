<?php

namespace App\Models\Translations;

use A17\Twill\Models\Model;
use App\Models\BlogPost;

class BlogPostTranslation extends Model
{
	protected $baseModuleModel = BlogPost::class;

	protected $casts = [
		'seo' => 'array',
	];
} 