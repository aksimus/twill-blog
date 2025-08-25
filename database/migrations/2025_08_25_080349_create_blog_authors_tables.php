<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_authors', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);
            
            $table->integer('position')->unsigned()->nullable();
            
            // Author specific fields
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('avatar')->nullable(); // For custom avatar path
            
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('blog_author_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'blog_author');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->text('bio')->nullable(); // Extended bio
            $table->string('job_title')->nullable(); // Professional title
        });

        Schema::create('blog_author_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'blog_author');
        });

        Schema::create('blog_author_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'blog_author');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_author_revisions');
        Schema::dropIfExists('blog_author_slugs');
        Schema::dropIfExists('blog_author_translations');
        Schema::dropIfExists('blog_authors');
    }
};
