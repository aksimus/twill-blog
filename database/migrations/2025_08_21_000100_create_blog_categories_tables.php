<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('blog_categories', function (Blueprint $table) {
			createDefaultTableFields($table);
		});

		Schema::create('blog_category_translations', function (Blueprint $table) {
			createDefaultTranslationsTableFields($table, 'blog_category');
			$table->string('title', 200)->nullable();
			$table->text('description')->nullable();
		});

		Schema::create('blog_category_slugs', function (Blueprint $table) {
			createDefaultSlugsTableFields($table, 'blog_category');
		});

		Schema::create('blog_category_revisions', function (Blueprint $table) {
			createDefaultRevisionsTableFields($table, 'blog_category');
		});
	}

	public function down()
	{
		Schema::dropIfExists('blog_category_revisions');
		Schema::dropIfExists('blog_category_translations');
		Schema::dropIfExists('blog_category_slugs');
		Schema::dropIfExists('blog_categories');
	}
}; 