<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Model;
use App\Services\TableOfContentsService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogPost extends Model
{
	use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions;

	protected $fillable = [
		'published',
		'hidden_from_categories',
		'settings',
		'hide_on_post_page',
		'hide_description_on_post_page',
		'blog_category_id',
		'blog_author_id',
		'blogCategory',
		'blogAuthor',
		'blogTags',
	];

	protected $casts = [
		'settings' => 'array',
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

	/**
	 * Get a setting value from the settings JSON field
	 */
	public function getSetting(string $key, $default = false): bool
	{
		return $this->settings[$key] ?? $default;
	}

	/**
	 * Helper accessor for hide_on_post_page setting
	 */
	public function getHideOnPostPageAttribute(): bool
	{
		return $this->getSetting('hide_on_post_page', false);
	}

	/**
	 * Helper accessor for hide_description_on_post_page setting
	 */
	public function getHideDescriptionOnPostPageAttribute(): bool
	{
		return $this->getSetting('hide_description_on_post_page', false);
	}

	/**
	 * Mutator for hide_on_post_page - converts to settings JSON
	 */
	public function setHideOnPostPageAttribute($value): void
	{
		$settings = $this->settings ?? [];
		$settings['hide_on_post_page'] = (bool) $value;
		$this->attributes['settings'] = json_encode($settings);
	}

	/**
	 * Mutator for hide_description_on_post_page - converts to settings JSON
	 */
	public function setHideDescriptionOnPostPageAttribute($value): void
	{
		$settings = $this->settings ?? [];
		$settings['hide_description_on_post_page'] = (bool) $value;
		$this->attributes['settings'] = json_encode($settings);
	}

	/**
	 * Helper accessor for show_toc setting
	 */
	public function getShowTocAttribute(): bool
	{
		// Default to true if not explicitly set
		return $this->getSetting('show_toc', true);
	}

	/**
	 * Mutator for show_toc - converts to settings JSON
	 */
	public function setShowTocAttribute($value): void
	{
		$settings = $this->settings ?? [];
		$settings['show_toc'] = (bool) $value;
		$this->attributes['settings'] = json_encode($settings);
	}

	/**
	 * Get complete blog post content with table of contents
	 * 
	 * @param bool $includeDescription Whether to include description in content
	 * @return array ['html' => string, 'toc' => array]
	 */
	public function getContentWithToc(bool $includeDescription = true): array
	{
		$html = '';

		// 1. Add description if visible
		if ($includeDescription && $this->description && !$this->hide_description_on_post_page) {
			$html .= $this->description;
		}

		// 2. Add content field if exists
		if ($this->content) {
			$html .= $this->content;
		}

		// 3. Add Twill blocks
		if (method_exists($this, 'renderBlocks')) {
			$blocksHtml = $this->renderBlocks();
			if ($blocksHtml) {
				$html .= $blocksHtml;
			}
		}

		// Generate ToC from aggregated HTML
		$service = app(TableOfContentsService::class);
		return $service->generateTableOfContents($html);
	}
} 