<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
	use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions;

	protected $fillable = [
		'published',
		'blog_category_id',
	];

	public $translatedAttributes = [
		'title',
		'description',
	];

	public $slugAttributes = [
		'title',
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(BlogCategory::class, 'blog_category_id');
	}

	public function blogTags(): BelongsToMany
	{
		return $this->belongsToMany(BlogTag::class, 'blog_post_blog_tag')
			->withPivot('position')
			->orderBy('position');
	}
} 