<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            createDefaultTableFields($table);
            $table->foreignId('category_id')->nullable()->constrained('categories');
        });

        Schema::create('post_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'post');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('post_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'post');
        });

        Schema::create('post_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'post');
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('post_revisions');
        Schema::dropIfExists('post_translations');
        Schema::dropIfExists('post_slugs');
        Schema::dropIfExists('posts');
    }
};
