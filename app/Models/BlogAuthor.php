<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogAuthor extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasPosition, HasFactory;

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
        'email',
        'website',
        'twitter',
        'linkedin',
        'github',
        'seo',
    ];
    
    public $translatedAttributes = [
        'title',
        'description',
        'bio',
        'job_title',
        'seo',
    ];
    
    public $slugAttributes = [
        'title',
    ];

    public $mediasParams = [
        'avatar' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 1,
                ],
            ],
        ],
    ];

    /**
     * Get the posts for this author
     */
    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'blog_author_id');
    }

    /**
     * Get the author's full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->title ?? 'Unknown Author';
    }

    /**
     * Get the author's avatar URL
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if ($this->hasImage('avatar')) {
            return $this->image('avatar', 'default');
        }
        
        // Return null if no avatar is set (views will handle default display)
        return null;
    }

    /**
     * Get the author's social links
     */
    public function getSocialLinksAttribute(): array
    {
        return [
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'github' => $this->github,
            'website' => $this->website,
        ];
    }
}
