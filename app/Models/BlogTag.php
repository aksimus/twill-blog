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
	];

	public $translatedAttributes = [
		'title',
		'description',
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