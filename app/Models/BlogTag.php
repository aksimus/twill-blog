<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Model;

class BlogTag extends Model
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
				['name' => 'list_desktop', 'ratio' => 2],    // 2:1 - Desktop list view (416x200px)
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
	 * Get the posts for this tag
	 */
	public function blogPosts()
	{
		return $this->belongsToMany(BlogPost::class, 'blog_post_blog_tag', 'blog_tag_id', 'blog_post_id');
	}
} 