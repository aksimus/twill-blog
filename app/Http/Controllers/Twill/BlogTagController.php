<?php

namespace App\Http\Controllers\Twill;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\BlockEditor;
use A17\Twill\Services\Forms\Fields\Input;
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
			Wysiwyg::make()->name('description')->label('Description')->translatable()
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