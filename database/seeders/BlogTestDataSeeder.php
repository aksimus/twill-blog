<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogPost;

class BlogTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 categories
        $categories = [];
        $categoryData = [
            ['en' => 'Technology', 'es' => 'Tecnología', 'ru' => 'Технологии'],
            ['en' => 'Science', 'es' => 'Ciencia', 'ru' => 'Наука'],
            ['en' => 'Business', 'es' => 'Negocios', 'ru' => 'Бизнес'],
            ['en' => 'Health', 'es' => 'Salud', 'ru' => 'Здоровье'],
            ['en' => 'Entertainment', 'es' => 'Entretenimiento', 'ru' => 'Развлечения'],
        ];

        foreach ($categoryData as $index => $titles) {
            $category = BlogCategory::create([
                'published' => true,
            ]);

            // Create translations for each locale
            foreach (['en', 'es', 'ru'] as $locale) {
                DB::table('blog_category_translations')->insert([
                    'blog_category_id' => $category->id,
                    'locale' => $locale,
                    'title' => $titles[$locale],
                    'description' => "Description for {$titles[$locale]} category in {$locale}",
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create slugs for each locale
                $slug = $this->generateSlug($titles[$locale], $locale);
                DB::table('blog_category_slugs')->insert([
                    'blog_category_id' => $category->id,
                    'slug' => $slug,
                    'locale' => $locale,
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $categories[] = $category;
        }

        // Create 10 tags
        $tags = [];
        $tagData = [
            ['en' => 'Artificial Intelligence', 'es' => 'Inteligencia Artificial', 'ru' => 'Искусственный Интеллект'],
            ['en' => 'Machine Learning', 'es' => 'Aprendizaje Automático', 'ru' => 'Машинное Обучение'],
            ['en' => 'Web Development', 'es' => 'Desarrollo Web', 'ru' => 'Веб-разработка'],
            ['en' => 'Data Science', 'es' => 'Ciencia de Datos', 'ru' => 'Наука о Данных'],
            ['en' => 'Cybersecurity', 'es' => 'Ciberseguridad', 'ru' => 'Кибербезопасность'],
            ['en' => 'Cloud Computing', 'es' => 'Computación en la Nube', 'ru' => 'Облачные Вычисления'],
            ['en' => 'Mobile Apps', 'es' => 'Aplicaciones Móviles', 'ru' => 'Мобильные Приложения'],
            ['en' => 'Blockchain', 'es' => 'Cadena de Bloques', 'ru' => 'Блокчейн'],
            ['en' => 'Internet of Things', 'es' => 'Internet de las Cosas', 'ru' => 'Интернет Вещей'],
            ['en' => 'Virtual Reality', 'es' => 'Realidad Virtual', 'ru' => 'Виртуальная Реальность'],
        ];

        foreach ($tagData as $titles) {
            $tag = BlogTag::create([
                'published' => true,
            ]);

            // Create translations for each locale
            foreach (['en', 'es', 'ru'] as $locale) {
                DB::table('blog_tag_translations')->insert([
                    'blog_tag_id' => $tag->id,
                    'locale' => $locale,
                    'title' => $titles[$locale],
                    'description' => "Description for {$titles[$locale]} tag in {$locale}",
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create slugs for each locale
                $slug = $this->generateSlug($titles[$locale], $locale);
                DB::table('blog_tag_slugs')->insert([
                    'blog_tag_id' => $tag->id,
                    'slug' => $slug,
                    'locale' => $locale,
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $tags[] = $tag;
        }

        // Create 20 blog posts with specific distribution
        $posts = [];
        
        // Category 0: Technology (0 posts)
        // Category 1: Science (5 posts)
        // Category 2: Business (10 posts)
        // Category 3: Health (5 posts)
        // Category 4: Entertainment (0 posts)

        $postTitles = [
            // Science posts (5)
            ['en' => 'The Future of Quantum Computing', 'es' => 'El Futuro de la Computación Cuántica', 'ru' => 'Будущее Квантовых Вычислений'],
            ['en' => 'Understanding Neural Networks', 'es' => 'Entendiendo las Redes Neuronales', 'ru' => 'Понимание Нейронных Сетей'],
            ['en' => 'Climate Change Research', 'es' => 'Investigación sobre el Cambio Climático', 'ru' => 'Исследование Изменения Климата'],
            ['en' => 'Space Exploration Advances', 'es' => 'Avances en la Exploración Espacial', 'ru' => 'Достижения в Космических Исследованиях'],
            ['en' => 'Genetic Engineering Breakthroughs', 'es' => 'Avances en Ingeniería Genética', 'ru' => 'Прорывы в Генетической Инженерии'],
            
            // Business posts (10)
            ['en' => 'Digital Transformation Strategies', 'es' => 'Estrategias de Transformación Digital', 'ru' => 'Стратегии Цифровой Трансформации'],
            ['en' => 'Startup Success Stories', 'es' => 'Historias de Éxito de Startups', 'ru' => 'Истории Успеха Стартапов'],
            ['en' => 'Remote Work Best Practices', 'es' => 'Mejores Prácticas para el Trabajo Remoto', 'ru' => 'Лучшие Практики Удаленной Работы'],
            ['en' => 'E-commerce Growth Trends', 'es' => 'Tendencias de Crecimiento del E-commerce', 'ru' => 'Тенденции Роста Электронной Коммерции'],
            ['en' => 'Sustainable Business Models', 'es' => 'Modelos de Negocio Sostenibles', 'ru' => 'Устойчивые Бизнес-модели'],
            ['en' => 'Leadership in Crisis', 'es' => 'Liderazgo en Crisis', 'ru' => 'Лидерство в Кризис'],
            ['en' => 'Innovation Management', 'es' => 'Gestión de la Innovación', 'ru' => 'Управление Инновациями'],
            ['en' => 'Customer Experience Design', 'es' => 'Diseño de Experiencia del Cliente', 'ru' => 'Дизайн Опыта Клиента'],
            ['en' => 'Data-Driven Decision Making', 'es' => 'Toma de Decisiones Basada en Datos', 'ru' => 'Принятие Решений на Основе Данных'],
            ['en' => 'Global Market Expansion', 'es' => 'Expansión del Mercado Global', 'ru' => 'Расширение Глобального Рынка'],
            
            // Health posts (5)
            ['en' => 'Mental Health Awareness', 'es' => 'Conciencia sobre la Salud Mental', 'ru' => 'Осведомленность о Психическом Здоровье'],
            ['en' => 'Nutrition Science', 'es' => 'Ciencia de la Nutrición', 'ru' => 'Наука о Питании'],
            ['en' => 'Exercise and Wellness', 'es' => 'Ejercicio y Bienestar', 'ru' => 'Упражнения и Здоровье'],
            ['en' => 'Preventive Healthcare', 'es' => 'Atención Médica Preventiva', 'ru' => 'Профилактическое Здравоохранение'],
            ['en' => 'Alternative Medicine', 'es' => 'Medicina Alternativa', 'ru' => 'Альтернативная Медицина'],
        ];

        $categoryIndex = 0;
        $postIndex = 0;

        foreach ($postTitles as $titles) {
            // Determine category based on post index
            if ($postIndex < 5) {
                $categoryId = $categories[1]->id; // Science
            } elseif ($postIndex < 15) {
                $categoryId = $categories[2]->id; // Business
            } else {
                $categoryId = $categories[3]->id; // Health
            }

            $post = BlogPost::create([
                'published' => true,
                'blog_category_id' => $categoryId,
            ]);

            // Create translations for each locale
            foreach (['en', 'es', 'ru'] as $locale) {
                DB::table('blog_post_translations')->insert([
                    'blog_post_id' => $post->id,
                    'locale' => $locale,
                    'title' => $titles[$locale],
                    'description' => "This is a detailed description of {$titles[$locale]} in {$locale}. It provides comprehensive information about the topic and its implications.",
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create slugs for each locale
                $slug = $this->generateSlug($titles[$locale], $locale);
                DB::table('blog_post_slugs')->insert([
                    'blog_post_id' => $post->id,
                    'slug' => $slug,
                    'locale' => $locale,
                    'active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Attach random number of tags (0-10)
            $numTags = rand(0, 10);
            if ($numTags > 0) {
                $selectedTags = collect($tags)->random(min($numTags, count($tags)));
                $post->blogTags()->attach($selectedTags->pluck('id')->toArray());
            }

            $posts[] = $post;
            $postIndex++;
        }

        // Update posts count for categories
        $this->updateCategoryPostsCount($categories);
    }

    /**
     * Generate a slug from title
     */
    private function generateSlug(string $title, string $locale): string
    {
        // For non-English locales, create a transliterated version
        if ($locale === 'ru') {
            $slug = $this->transliterateRussian($title);
        } elseif ($locale === 'es') {
            $slug = $this->transliterateSpanish($title);
        } else {
            $slug = $title;
        }
        
        // Convert to lowercase and replace non-alphanumeric characters with hyphens
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
        $slug = trim($slug, '-');
        
        // Ensure slug is not empty
        if (empty($slug)) {
            $slug = 'category-' . $locale;
        }
        
        return $slug;
    }

    /**
     * Transliterate Russian text to Latin characters
     */
    private function transliterateRussian(string $text): string
    {
        $russian = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm',
            'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'ts', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
        ];
        
        return strtr(mb_strtolower($text, 'UTF-8'), $russian);
    }

    /**
     * Transliterate Spanish text (remove accents)
     */
    private function transliterateSpanish(string $text): string
    {
        $spanish = [
            'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u',
            'ñ' => 'n', 'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ü' => 'U', 'Ñ' => 'N'
        ];
        
        return strtr($text, $spanish);
    }

    /**
     * Update posts count for categories
     */
    private function updateCategoryPostsCount(array $categories): void
    {
        // Technology (0 posts) - already 0
        // Science (5 posts) - already 5
        // Business (10 posts) - already 10
        // Health (5 posts) - already 5
        // Entertainment (0 posts) - already 0
        
        // The distribution is handled in the post creation loop above
    }
} 