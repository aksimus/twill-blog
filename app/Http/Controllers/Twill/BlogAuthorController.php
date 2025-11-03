<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class BlogAuthorController extends BaseModuleController
{
    protected $moduleName = 'blogAuthors';
    
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {

        $this->setPermalinkBase('blog/author');
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        // Basic Information
        $form->add(
            Input::make()->name('email')->label('Email')->type('email')
        );

        $form->add(
            Input::make()->name('website')->label('Website')->type('url')
        );

        $form->add(
            Input::make()->name('job_title')->label('Job Title')->translatable()
        );

        $form->add(
            Wysiwyg::make()->name('bio')->label('Bio')->translatable()
        );

        // Social Media Links
        $form->add(
            Input::make()->name('twitter')->label('Twitter Username')->placeholder('@username')
        );

        $form->add(
            Input::make()->name('linkedin')->label('LinkedIn Profile')->type('url')
        );

        $form->add(
            Input::make()->name('github')->label('GitHub Username')
        );

        // Media
        $form->add(
            Medias::make()->name('avatar')->label('Avatar')->max(1)
        );

        // SEO Section
        $form->add(
            Input::make()
                ->name('seo.h1_header')
                ->label('H1 Header')
                ->translatable()
                ->note('Leave empty to use title as H1')
        );

        $form->add(
            Input::make()
                ->name('seo.meta_description')
                ->label('Meta Description')
                ->translatable()
                ->note('Recommended: 150-160 characters for optimal SEO')
        );

        $form->add(
            Input::make()
                ->name('seo.meta_keywords')
                ->label('Meta Keywords')
                ->translatable()
                ->note('Comma-separated keywords (optional but useful for internal search)')
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('email')->title('Email')
        );

        $table->add(
            Text::make()->field('job_title')->title('Job Title')
        );

        return $table;
    }
}
