<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\BlogTag;

class BlogTagRepository extends ModuleRepository
{
	use HandleBlocks, HandleTranslations, HandleSlugs, HandleMedias, HandleRevisions;

	protected array $fieldsGroups = [
		'seo' => [
			'h1_header',
			'meta_description',
			'meta_keywords',
		],
	];

	public bool $fieldsGroupsFormFieldNamesAutoPrefix = true;
	public string $fieldsGroupsFormFieldNameSeparator = '.';

	public function __construct(BlogTag $model)
	{
		$this->model = $model;
	}
} 