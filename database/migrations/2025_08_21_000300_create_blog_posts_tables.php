<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('blog_posts', function (Blueprint $table) {
			createDefaultTableFields($table);
			$table->unsignedBigInteger('blog_category_id')->nullable()->index();
		});

		Schema::create('blog_post_translations', function (Blueprint $table) {
			createDefaultTranslationsTableFields($table, 'blog_post');
			$table->string('title', 200)->nullable();
			$table->text('description')->nullable();
		});

		Schema::create('blog_post_slugs', function (Blueprint $table) {
			createDefaultSlugsTableFields($table, 'blog_post');
		});

		Schema::create('blog_post_revisions', function (Blueprint $table) {
			createDefaultRevisionsTableFields($table, 'blog_post');
		});
	}

	public function down()
	{
		Schema::dropIfExists('blog_post_revisions');
		Schema::dropIfExists('blog_post_translations');
		Schema::dropIfExists('blog_post_slugs');
		Schema::dropIfExists('blog_posts');
	}
}; 