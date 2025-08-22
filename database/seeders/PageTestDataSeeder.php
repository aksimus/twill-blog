<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\PageRepository;
use Illuminate\Support\Facades\DB;

class PageTestDataSeeder extends Seeder
{
    public function run(): void
    {
        $pageRepository = app(PageRepository::class);

        // Create Homepage
        $homepage = $pageRepository->create([
            'published' => true,
        ]);

        // Update homepage translations
        DB::table('page_translations')
            ->where('page_id', $homepage->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Welcome to Our Website',
                'description' => 'This is the homepage of our multilingual website built with Twill CMS.',
            ]);

        DB::table('page_translations')
            ->where('page_id', $homepage->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Bienvenido a Nuestro Sitio Web',
                'description' => 'Esta es la página de inicio de nuestro sitio web multilingüe construido con Twill CMS.',
                'active' => 1,
            ]);

        DB::table('page_translations')
            ->where('page_id', $homepage->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Добро пожаловать на наш веб-сайт',
                'description' => 'Это главная страница нашего многоязычного веб-сайта, созданного с помощью Twill CMS.',
                'active' => 1,
            ]);

        // Create slugs for homepage (homepage should have empty slug for root URL)
        DB::table('page_slugs')->insert([
            [
                'page_id' => $homepage->id,
                'slug' => '',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $homepage->id,
                'slug' => '',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $homepage->id,
                'slug' => '',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create Features Page
        $featuresPage = $pageRepository->create([
            'published' => true,
        ]);

        // Update features page translations
        DB::table('page_translations')
            ->where('page_id', $featuresPage->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Features',
                'description' => 'Discover the amazing features of our platform.',
            ]);

        DB::table('page_translations')
            ->where('page_id', $featuresPage->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Características',
                'description' => 'Descubre las increíbles características de nuestra plataforma.',
                'active' => 1,
            ]);

        DB::table('page_translations')
            ->where('page_id', $featuresPage->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Возможности',
                'description' => 'Откройте для себя удивительные возможности нашей платформы.',
                'active' => 1,
            ]);

        // Create slugs for features page
        DB::table('page_slugs')->insert([
            [
                'page_id' => $featuresPage->id,
                'slug' => 'features',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $featuresPage->id,
                'slug' => 'features',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $featuresPage->id,
                'slug' => 'features',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create About Page
        $aboutPage = $pageRepository->create([
            'published' => true,
        ]);

        // Update about page translations
        DB::table('page_translations')
            ->where('page_id', $aboutPage->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'About Us',
                'description' => 'Learn more about our company and mission.',
            ]);

        DB::table('page_translations')
            ->where('page_id', $aboutPage->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Acerca de Nosotros',
                'description' => 'Conoce más sobre nuestra empresa y misión.',
                'active' => 1,
            ]);

        DB::table('page_translations')
            ->where('page_id', $aboutPage->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'О нас',
                'description' => 'Узнайте больше о нашей компании и миссии.',
                'active' => 1,
            ]);

        // Create slugs for about page
        DB::table('page_slugs')->insert([
            [
                'page_id' => $aboutPage->id,
                'slug' => 'about',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $aboutPage->id,
                'slug' => 'about',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'page_id' => $aboutPage->id,
                'slug' => 'about',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 