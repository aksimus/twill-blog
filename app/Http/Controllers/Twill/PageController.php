<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;

class PageController extends BaseModuleController
{
    protected $moduleName = 'pages';

    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->setPermalinkBase('');
        //$this->withoutLanguageInPermalink();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        // Basic content fields
        $form->add(
            Input::make()->name('description')->label('Description')->translatable()
        );

        $form->add(
            Medias::make()->name('cover')->label('Cover image')
        );

        // SEO Section
        $form->add(
            Input::make()
                ->name('seo_section')
                ->label('SEO Settings')
                ->readOnly()
                ->default('SEO configuration below')
        );

        $form->add(
            Input::make()
                ->name('h1_header')
                ->label('H1 Header')
                ->translatable()
                ->note('Leave empty to use title as H1')
        );

        $form->add(
            Input::make()
                ->name('meta_description')
                ->label('Meta Description')
                ->translatable()
                ->note('Recommended: 150-160 characters for optimal SEO')
        );

        $form->add(
            Input::make()
                ->name('meta_keywords')
                ->label('Meta Keywords')
                ->translatable()
                ->note('Comma-separated keywords (optional but useful for internal search)')
        );

        // Enhanced content editor
        $form->add(
            Input::make()
                ->name('content_section')
                ->label('Content')
                ->readOnly()
                ->default('Page content below')
        );

        $form->add(
            Wysiwyg::make()
                ->name('content')
                ->label('Page Content')
                ->translatable()
                ->note('Rich text editor with image upload support')
        );

        $form->add(
            BlockEditor::make()
                ->label('Advanced Content Blocks')
                ->note('Use blocks for complex layouts and components')
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
            Text::make()->field('description')->title('Description')
        );

        $table->add(
            Text::make()->field('meta_description')->title('Meta Description')
        );

        return $table;
    }
}
