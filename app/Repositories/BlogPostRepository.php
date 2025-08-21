<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleBrowsers;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\BlogPost;

class BlogPostRepository extends ModuleRepository
{
	use HandleBlocks, HandleTranslations, HandleSlugs, HandleMedias, HandleRevisions, HandleBrowsers;

	public function __construct(BlogPost $model)
	{
		$this->model = $model;
		$this->browsers = [
			'blogCategory' => [
				'relation' => 'category',
				'moduleName' => 'blogCategories',
			],
			'blogTags' => [
				'relation' => 'blogTags',
				'moduleName' => 'blogTags',
			],
		];
	}
} 