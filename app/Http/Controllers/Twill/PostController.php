<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Fields\Browser;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class PostController extends BaseModuleController
{
    protected $moduleName = 'posts';

    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->add(
            Wysiwyg::make()->name('description')->label('Description')->translatable()
        );

        $form->add(
            Browser::make()->name('category')->module('categories')->max(1)
        );

        $form->add(
            Browser::make()->name('tags')->module('tags')
        );

        return $form;
    }
}
