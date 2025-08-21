<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleTranslations;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Post;

class PostRepository extends ModuleRepository
{
    use HandleTranslations, HandleSlugs, HandleRevisions;

    protected array $relatedBrowsers = ['category', 'tags'];

    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}
