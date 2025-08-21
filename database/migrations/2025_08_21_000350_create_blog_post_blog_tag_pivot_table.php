<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up()
	{
		Schema::create('blog_post_blog_tag', function (Blueprint $table) {
			$table->unsignedBigInteger('blog_post_id');
			$table->unsignedBigInteger('blog_tag_id');
			$table->integer('position')->nullable();
			$table->primary(['blog_post_id', 'blog_tag_id']);
		});
	}

	public function down()
	{
		Schema::dropIfExists('blog_post_blog_tag');
	}
}; 