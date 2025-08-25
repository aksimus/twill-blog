<?php

namespace App\Console\Commands;

use App\Models\BlogAuthor;
use App\Models\BlogPost;
use Illuminate\Console\Command;

class TestBlogAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:test-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the new BlogAuthor module and its integration with BlogPost';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing BlogAuthor module...');

        // Check if authors exist
        $authors = BlogAuthor::with('posts')->get();
        
        if ($authors->isEmpty()) {
            $this->error('No blog authors found. Please run the BlogAuthorSeeder first.');
            return 1;
        }

        $this->info("Found {$authors->count()} authors:");

        foreach ($authors as $author) {
            $this->line("  - {$author->full_name} ({$author->email})");
            
            if ($author->job_title) {
                $this->line("    Job: {$author->job_title}");
            }
            
            if ($author->posts) {
                $this->line("    Posts: {$author->posts->count()}");
            }
            
            // Show social links
            $socialLinks = array_filter($author->social_links);
            if (!empty($socialLinks)) {
                $this->line("    Social: " . implode(', ', array_keys($socialLinks)));
            }
        }

        // Check posts with authors
        $postsWithAuthors = BlogPost::with(['author', 'category'])->whereNotNull('blog_author_id')->get();
        
        if ($postsWithAuthors->isEmpty()) {
            $this->warn('No posts with authors found. You may need to assign authors to posts in Twill Admin.');
        } else {
            $this->info("\nPosts with authors:");
            foreach ($postsWithAuthors as $post) {
                $this->line("  - {$post->title} by {$post->author->full_name}");
            }
        }

        // Check posts without authors
        $postsWithoutAuthors = BlogPost::whereNull('blog_author_id')->get();
        if ($postsWithoutAuthors->isNotEmpty()) {
            $this->warn("\nPosts without authors: {$postsWithoutAuthors->count()}");
            $this->line('You can assign authors to these posts in Twill Admin.');
        }

        $this->info("\nBlogAuthor module test completed successfully!");
        $this->info("You can now:");
        $this->line("  1. Visit Twill Admin: /admin");
        $this->line("  2. Go to Blog Authors section");
        $this->line("  3. Create/edit authors and assign them to posts");

        return 0;
    }
} 