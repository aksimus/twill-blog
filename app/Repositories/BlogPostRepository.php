<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\BlogPost;

class BlogPostRepository extends ModuleRepository
{
    public function __construct(BlogPost $model)
    {
        $this->model = $model;
    }
}

