<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use Illuminate\Console\Command;

class TestBlogTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:test-template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the new blog template structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing new blog template structure...');

        // Get a published blog post
        $post = BlogPost::with(['category', 'blogTags', 'author'])
            ->where('published', true)
            ->first();

        if (!$post) {
            $this->error('No published blog posts found. Please create some posts first.');
            return 1;
        }

        $this->info("Found post: {$post->title}");
        
        if ($post->category) {
            $this->info("Category: {$post->category->title}");
        }
        
        if ($post->blogTags && $post->blogTags->count() > 0) {
            $this->info("Tags: " . $post->blogTags->pluck('title')->implode(', '));
        }

        // Test if the post has blocks
        if (method_exists($post, 'renderBlocks')) {
            $this->info("Post has blocks: " . ($post->blocks ? 'Yes' : 'No'));
        }

        // Test if the post has translations
        $this->info("Post has translations: " . ($post->translations ? 'Yes' : 'No'));

        $this->info('Template test completed successfully!');
        $this->info("You can now visit: /" . app()->getLocale() . "/blog/{$post->getSlug()}");

        return 0;
    }
} 