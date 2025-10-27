<?php

namespace App\Http\Requests\Twill;

use A17\Twill\Http\Requests\Admin\Request;

class BlogPostRequest extends Request
{
	public function rulesForCreate()
	{
		$rules = [];
		$rules = $this->rulesForTranslatedFields($rules, [
			'title' => 'required|string|max:200',
			'description' => 'nullable|string',
		]);
		$rules['hidden_from_categories'] = 'boolean';
		$rules['hide_on_post_page'] = 'nullable|boolean';
		$rules['hide_description_on_post_page'] = 'nullable|boolean';
		$rules['settings.hide_on_post_page'] = 'nullable|boolean';
		$rules['settings.hide_description_on_post_page'] = 'nullable|boolean';
		// Support for nested form fields: settings[key]
		$rules['settings[hide_on_post_page]'] = 'nullable|boolean';
		$rules['settings[hide_description_on_post_page]'] = 'nullable|boolean';
		return $rules;
	}

	public function rulesForUpdate()
	{
		return $this->rulesForCreate();
	}
} 