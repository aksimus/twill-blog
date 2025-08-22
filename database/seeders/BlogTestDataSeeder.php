<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogPost;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogTagRepository;
use App\Repositories\BlogPostRepository;

class BlogTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Technology News category
        $techCategory = app(BlogCategoryRepository::class)->create([
            'published' => true,
        ]);

        // Update the existing translations that Twill created
        DB::table('blog_category_translations')
            ->where('blog_category_id', $techCategory->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Technology News',
                'description' => 'Latest technology updates and innovations',
            ]);
        
        DB::table('blog_category_translations')
            ->where('blog_category_id', $techCategory->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Noticias de Tecnología',
                'description' => 'Últimas actualizaciones e innovaciones tecnológicas',
                'active' => 1,
            ]);
        
        DB::table('blog_category_translations')
            ->where('blog_category_id', $techCategory->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Новости технологий',
                'description' => 'Последние обновления и инновации в технологиях',
                'active' => 1,
            ]);

        // Create slugs for Technology News category
        DB::table('blog_category_slugs')->insert([
            [
                'blog_category_id' => $techCategory->id,
                'slug' => 'technology-news',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_category_id' => $techCategory->id,
                'slug' => 'noticias-de-tecnologia',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_category_id' => $techCategory->id,
                'slug' => 'novosti-tehnologij',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create Science category
        $scienceCategory = app(BlogCategoryRepository::class)->create([
            'published' => true,
        ]);

        DB::table('blog_category_translations')
            ->where('blog_category_id', $scienceCategory->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Science',
                'description' => 'Scientific discoveries and research',
            ]);
        
        DB::table('blog_category_translations')
            ->where('blog_category_id', $scienceCategory->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Ciencia',
                'description' => 'Descubrimientos científicos e investigaciones',
                'active' => 1,
            ]);
        
        DB::table('blog_category_translations')
            ->where('blog_category_id', $scienceCategory->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Наука',
                'description' => 'Научные открытия и исследования',
                'active' => 1,
            ]);

        // Create slugs for Science category
        DB::table('blog_category_slugs')->insert([
            [
                'blog_category_id' => $scienceCategory->id,
                'slug' => 'science',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_category_id' => $scienceCategory->id,
                'slug' => 'ciencia',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_category_id' => $scienceCategory->id,
                'slug' => 'nauka',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create AI tag
        $aiTag = app(BlogTagRepository::class)->create([
            'published' => true,
        ]);

        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $aiTag->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Artificial Intelligence',
                'description' => 'AI related content and discussions',
            ]);
        
        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $aiTag->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Inteligencia Artificial',
                'description' => 'Contenido y discusiones relacionadas con IA',
                'active' => 1,
            ]);
        
        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $aiTag->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Искусственный интеллект',
                'description' => 'Контент и обсуждения, связанные с ИИ',
                'active' => 1,
            ]);

        // Create slugs for AI tag
        DB::table('blog_tag_slugs')->insert([
            [
                'blog_tag_id' => $aiTag->id,
                'slug' => 'artificial-intelligence',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_tag_id' => $aiTag->id,
                'slug' => 'inteligencia-artificial',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_tag_id' => $aiTag->id,
                'slug' => 'iskusstvennyj-intellekt',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create Machine Learning tag
        $mlTag = app(BlogTagRepository::class)->create([
            'published' => true,
        ]);

        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $mlTag->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Machine Learning',
                'description' => 'Machine learning algorithms and applications',
            ]);
        
        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $mlTag->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Aprendizaje Automático',
                'description' => 'Algoritmos y aplicaciones de aprendizaje automático',
                'active' => 1,
            ]);
        
        DB::table('blog_tag_translations')
            ->where('blog_tag_id', $mlTag->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Машинное обучение',
                'description' => 'Алгоритмы и приложения машинного обучения',
                'active' => 1,
            ]);

        // Create slugs for Machine Learning tag
        DB::table('blog_tag_slugs')->insert([
            [
                'blog_tag_id' => $mlTag->id,
                'slug' => 'machine-learning',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_tag_id' => $mlTag->id,
                'slug' => 'aprendizaje-automatico',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_tag_id' => $mlTag->id,
                'slug' => 'mashinnoe-obuchenie',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create AI Breakthrough post
        $aiPost = app(BlogPostRepository::class)->create([
            'published' => true,
            'blog_category_id' => $techCategory->id,
        ]);

        DB::table('blog_post_translations')
            ->where('blog_post_id', $aiPost->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'AI Breakthrough in 2024',
                'description' => 'Major breakthrough in artificial intelligence technology that will revolutionize the industry.',
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $aiPost->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Avance de IA en 2024',
                'description' => 'Gran avance en tecnología de inteligencia artificial que revolucionará la industria.',
                'active' => 1,
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $aiPost->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Прорыв в ИИ в 2024 году',
                'description' => 'Крупный прорыв в технологии искусственного интеллекта, который революционизирует отрасль.',
                'active' => 1,
            ]);

        // Create slugs for AI Breakthrough post
        DB::table('blog_post_slugs')->insert([
            [
                'blog_post_id' => $aiPost->id,
                'slug' => 'ai-breakthrough-in-2024',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $aiPost->id,
                'slug' => 'avance-de-ia-en-2024',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $aiPost->id,
                'slug' => 'proryv-v-ii-v-2024-godu',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create Machine Learning Trends post
        $mlPost = app(BlogPostRepository::class)->create([
            'published' => true,
            'blog_category_id' => $techCategory->id,
        ]);

        DB::table('blog_post_translations')
            ->where('blog_post_id', $mlPost->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Machine Learning Trends',
                'description' => 'Latest trends in machine learning and their impact on various industries.',
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $mlPost->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Tendencias en Aprendizaje Automático',
                'description' => 'Últimas tendencias en aprendizaje automático y su impacto en varias industrias.',
                'active' => 1,
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $mlPost->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Тенденции в машинном обучении',
                'description' => 'Последние тенденции в машинном обучении и их влияние на различные отрасли.',
                'active' => 1,
            ]);

        // Create slugs for Machine Learning Trends post
        DB::table('blog_post_slugs')->insert([
            [
                'blog_post_id' => $mlPost->id,
                'slug' => 'machine-learning-trends',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $mlPost->id,
                'slug' => 'tendencias-en-aprendizaje-automatico',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $mlPost->id,
                'slug' => 'tendencii-v-mashinnom-obuchenii',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create Quantum Computing post
        $quantumPost = app(BlogPostRepository::class)->create([
            'published' => true,
            'blog_category_id' => $scienceCategory->id,
        ]);

        DB::table('blog_post_translations')
            ->where('blog_post_id', $quantumPost->id)
            ->where('locale', 'en')
            ->update([
                'title' => 'Quantum Computing Revolution',
                'description' => 'How quantum computing is changing the future of computation and cryptography.',
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $quantumPost->id)
            ->where('locale', 'es')
            ->update([
                'title' => 'Revolución de la Computación Cuántica',
                'description' => 'Cómo la computación cuántica está cambiando el futuro de la computación y la criptografía.',
                'active' => 1,
            ]);
        
        DB::table('blog_post_translations')
            ->where('blog_post_id', $quantumPost->id)
            ->where('locale', 'ru')
            ->update([
                'title' => 'Революция квантовых вычислений',
                'description' => 'Как квантовые вычисления меняют будущее вычислений и криптографии.',
                'active' => 1,
            ]);

        // Create slugs for Quantum Computing post
        DB::table('blog_post_slugs')->insert([
            [
                'blog_post_id' => $quantumPost->id,
                'slug' => 'quantum-computing-revolution',
                'locale' => 'en',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $quantumPost->id,
                'slug' => 'revolucion-de-la-computacion-cuantica',
                'locale' => 'es',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'blog_post_id' => $quantumPost->id,
                'slug' => 'revoljucija-kvantovyh-vychislenij',
                'locale' => 'ru',
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Attach tags to posts
        $aiPost->blogTags()->attach([$aiTag->id, $mlTag->id], ['position' => 1]);
        $mlPost->blogTags()->attach([$mlTag->id], ['position' => 1]);
        $quantumPost->blogTags()->attach([$aiTag->id], ['position' => 1]);
    }
} 