<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Medias;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;

class BlogTagController extends BaseModuleController
{
	protected $moduleName = 'blogTags';
	protected $request = \App\Http\Requests\Twill\BlogTagRequest::class;

	protected function setUpController(): void
	{
		$this->setPermalinkBase('blog/tag');
		//$this->withoutLanguageInPermalink();
	}

	public function getForm(TwillModelContract $model): Form
	{
		$form = parent::getForm($model);

		$form->add(
			Input::make()->name('title')->label('Title')->translatable()
		);

		$form->add(
			Medias::make()->name('hero')->label('Hero Image')->max(1)
		);

		$form->add(
			Wysiwyg::make()->name('description')->label('Description')->translatable()
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

		$form->add(
			BlockEditor::make()
		);

		return $form;
	}

	protected function additionalIndexTableColumns(): TableColumns
	{
		$table = parent::additionalIndexTableColumns();
		$table->add(Text::make()->field('description')->title('Description'));
		return $table;
	}
} 