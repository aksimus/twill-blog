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
    protected $description = 'Seed the database with blog test data for multilingual testing';

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
            
            $this->info('🎉 Blog test data seeded successfully!');
            $this->info('');
            $this->info('📊 Summary:');
            $this->info("   - Categories: 2 (Technology News, Science)");
            $this->info("   - Tags: 2 (AI, Machine Learning)");
            $this->info("   - Posts: 3 (AI Breakthrough, ML Trends, Quantum Computing)");
            $this->info('');
            $this->info('🌍 All content is available in: English (en), Spanish (es), Russian (ru)');
            $this->info('');
            $this->info('🔗 Test URLs:');
            $this->info('   - Blog index: /blog, /es/blog, /ru/blog');
            $this->info('   - Category: /blog/category/technology-news, /es/blog/category/noticias-de-tecnologia');
            $this->info('   - Tag: /blog/tag/artificial-intelligence, /es/blog/tag/inteligencia-artificial');
            $this->info('   - Post: /blog/ai-breakthrough-in-2024, /es/blog/avance-de-ia-en-2024');
            $this->info('');
            $this->info('📝 You can now test the multilingual functionality:');
            $this->info('   - Visit /blog, /es/blog, /ru/blog');
            $this->info('   - Test category pages with different languages');
            $this->info('   - Test tag pages with different languages');
            $this->info('   - Test individual post pages with different languages');
            $this->info('   - Use the language switcher on any page');
            
        } catch (\Exception $e) {
            $this->error('❌ Error seeding blog test data: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
        
        return 0;
    }
} 