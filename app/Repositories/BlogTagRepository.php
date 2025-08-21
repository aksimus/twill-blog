<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\BlogTag;

class BlogTagRepository extends ModuleRepository
{
    public function __construct(BlogTag $model)
    {
        $this->model = $model;
    }
}

