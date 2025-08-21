<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('blog_tags', function (Blueprint $table) {
			createDefaultTableFields($table);
		});

		Schema::create('blog_tag_translations', function (Blueprint $table) {
			createDefaultTranslationsTableFields($table, 'blog_tag');
			$table->string('title', 200)->nullable();
			$table->text('description')->nullable();
		});

		Schema::create('blog_tag_slugs', function (Blueprint $table) {
			createDefaultSlugsTableFields($table, 'blog_tag');
		});

		Schema::create('blog_tag_revisions', function (Blueprint $table) {
			createDefaultRevisionsTableFields($table, 'blog_tag');
		});
	}

	public function down()
	{
		Schema::dropIfExists('blog_tag_revisions');
		Schema::dropIfExists('blog_tag_translations');
		Schema::dropIfExists('blog_tag_slugs');
		Schema::dropIfExists('blog_tags');
	}
}; 