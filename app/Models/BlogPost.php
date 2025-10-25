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
		'blog_author_id',
		'blogCategory',
		'blogAuthor',
		'blogTags',
	];
	public $mediasParams = [
		'hero' => [
				'default' => [
					[
						'name' => 'default',
						'ratio' => 16 / 9,
					],
				],

		  'post_desktop' => [
			['name' => 'post_desktop', 'ratio' => 2.75],      // 11:4 - Silicon desktop single post hero
		  ],
		  'post_mobile' => [
			['name' => 'post_mobile', 'ratio' => 1.25],    // 5:4 - Silicon mobile single post hero
		  ],
		  'cat_desktop' => [
			['name' => 'cat_desktop', 'ratio' => 1.51],    // 3:2 - Silicon desktop blog list (432x286px from DOM)
		  ],
		  'cat_mobile' => [
			['name' => 'cat_mobile', 'ratio' => 1.46],    // 3:2 - Silicon mobile blog list (351x240px from DOM)
		  ],
		],

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

	public function author(): BelongsTo
	{
		return $this->belongsTo(BlogAuthor::class, 'blog_author_id');
	}

	public function blogTags(): BelongsToMany
	{
		return $this->belongsToMany(BlogTag::class, 'blog_post_blog_tag')
			->withPivot('position')
			->orderBy('position');
	}
} 