<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('page_translations', function (Blueprint $table) {
            $table->string('h1_header', 200)->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('h1_header');
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->longText('content')->nullable()->after('meta_keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_translations', function (Blueprint $table) {
            $table->dropColumn(['h1_header', 'meta_description', 'meta_keywords', 'content']);
        });
    }
};
