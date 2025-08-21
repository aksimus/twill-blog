<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            createDefaultTableFields($table);
        });

        Schema::create('tag_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'tag');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
        });

        Schema::create('tag_slugs', function (Blueprint $table) {
            createDefaultSlugsTableFields($table, 'tag');
        });

        Schema::create('tag_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'tag');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tag_revisions');
        Schema::dropIfExists('tag_translations');
        Schema::dropIfExists('tag_slugs');
        Schema::dropIfExists('tags');
    }
};
