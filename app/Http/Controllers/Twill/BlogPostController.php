<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Wysiwyg;
use A17\Twill\Services\Forms\Fields\Browser;
use A17\Twill\Services\Forms\Form;

class BlogPostController extends BaseModuleController
{
	protected $moduleName = 'blogPosts';
	protected $request = \App\Http\Requests\BlogPostRequest::class;

	protected function setUpController(): void
	{
		$this->setPermalinkBase('blog');
		//$this->withoutLanguageInPermalink();
	}

	public function getForm(TwillModelContract $model): Form
	{
		$form = parent::getForm($model);

		$form->add(
			Input::make()->name('title')->label('Title')->translatable()
		);

		$form->add(
			Wysiwyg::make()->name('description')->label('Description')->translatable()
		);

		$form->add(
			Browser::make()
				->modules(['blogCategories'])
				->label('Main category')
				->name('blogCategory')
				->max(1)
		);

		$form->add(
			Browser::make()
				->modules(['blogAuthors'])
				->label('Author')
				->name('blogAuthor')
				->max(1)
		);

		$form->add(
			Browser::make()
				->modules(['blogTags'])
				->label('Tags')
				->name('blogTags')
				->max(10)
		);

		$form->add(
			BlockEditor::make()
		);

		return $form;
	}
} 