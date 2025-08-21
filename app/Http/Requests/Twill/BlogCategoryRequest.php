<?php

namespace App\Http\Requests\Twill;

use A17\Twill\Http\Requests\Admin\Request;

class BlogCategoryRequest extends Request
{
	public function rulesForCreate()
	{
		$rules = [];
		$rules = $this->rulesForTranslatedFields($rules, [
			'title' => 'required|string|max:200',
		]);
		return $rules;
	}

	public function rulesForUpdate()
	{
		return $this->rulesForCreate();
	}
} 