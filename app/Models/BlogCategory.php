<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Model;

class BlogCategory extends Model
{
	use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions;

	protected $fillable = [
		'published',
		'seo',
	];

	public $mediasParams = [
		'hero' => [
			'default' => [
				[
					'name' => 'default',
					'ratio' => 2,
				],
			],
			'list_desktop' => [
				['name' => 'list_desktop', 'ratio' => 2],    // 2:1 - Desktop list view
			],
			'list_mobile' => [
				['name' => 'list_mobile', 'ratio' => 2],    // 2:1 - Mobile list view
			],
		],
	];

	public $translatedAttributes = [
		'title',
		'description',
		'seo',
	];

	public $slugAttributes = [
		'title',
	];

	/**
	 * Get the posts for this category
	 */
	public function posts()
	{
		return $this->hasMany(BlogPost::class, 'blog_category_id');
	}
} 