<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\PageTestDataSeeder;

class SeedPageTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pages:seed-test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with multilingual page test data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding multilingual page test data...');
        
        $seeder = new PageTestDataSeeder();
        $seeder->run();
        
        $this->info('✅ Page test data seeded successfully!');
        $this->line('');
        $this->line('📄 Test pages created:');
        $this->line('  • Homepage (/)');
        $this->line('    - English: /');
        $this->line('    - Spanish: /es');
        $this->line('    - Russian: /ru');
        $this->line('');
        $this->line('  • Features page (/features)');
        $this->line('    - English: /features');
        $this->line('    - Spanish: /es/features');
        $this->line('    - Russian: /ru/features');
        $this->line('');
        $this->line('  • About page (/about)');
        $this->line('    - English: /about');
        $this->line('    - Spanish: /es/about');
        $this->line('    - Russian: /ru/about');
        $this->line('');
        $this->line('🌐 You can now test the multilingual functionality!');
        
        return 0;
    }
} 