<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\BlogTestDataSeeder;

class SeedBlogTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:seed-test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with comprehensive multilingual blog test data (5 categories, 10 tags, 20 posts)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting blog test data seeding...');
        
        try {
            $this->info('🌱 Creating categories, tags, and posts...');
            
            $seeder = new BlogTestDataSeeder();
            $seeder->run();
            
            $this->info('Blog test data seeded successfully!');
            $this->info('');
            $this->info('Created:');
            $this->info('- 5 categories (Technology: 0 posts, Science: 5 posts, Business: 10 posts, Health: 5 posts, Entertainment: 0 posts)');
            $this->info('- 10 tags (AI, ML, Web Dev, Data Science, Cybersecurity, Cloud, Mobile, Blockchain, IoT, VR)');
            $this->info('- 20 blog posts with random tag attachments (0-10 tags per post)');
            $this->info('');
            $this->info('Test URLs:');
            $this->info('- Blog index: /blog');
            $this->info('- Categories: /blog/category/science, /blog/category/business, /blog/category/health');
            $this->info('- Tags: /blog/tag/artificial-intelligence, /blog/tag/machine-learning');
            $this->info('- Posts: /blog/the-future-of-quantum-computing, /blog/digital-transformation-strategies');
            $this->info('');
            $this->info('Multilingual support:');
            $this->info('- English: /blog (no prefix)');
            $this->info('- Spanish: /es/blog');
            $this->info('- Russian: /ru/blog');
            
        } catch (\Exception $e) {
            $this->error('❌ Error seeding blog test data: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
        
        return 0;
    }
} 