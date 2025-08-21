<?php

namespace App\Repositories;

use A17\Twill\Repositories\ModuleRepository;
use App\Models\BlogCategory;

class BlogCategoryRepository extends ModuleRepository
{
    public function __construct(BlogCategory $model)
    {
        $this->model = $model;
    }
}

