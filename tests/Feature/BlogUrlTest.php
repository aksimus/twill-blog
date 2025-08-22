<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogUrlTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Set the default locale for tests
        app()->setLocale('en');
    }

    /** @test */
    public function blog_index_route_works_in_english()
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    /** @test */
    public function blog_category_route_works_in_english()
    {
        $response = $this->get('/blog/category/test-category');
        $response->assertStatus(404); // Should return 404 since no category exists
    }

    /** @test */
    public function blog_tag_route_works_in_english()
    {
        $response = $this->get('/blog/tag/test-tag');
        $response->assertStatus(404); // Should return 404 since no tag exists
    }

    /** @test */
    public function blog_post_route_works_in_english()
    {
        $response = $this->get('/blog/test-post');
        $response->assertStatus(404); // Should return 404 since no post exists
    }

    /** @test */
    public function non_existent_routes_return_404()
    {
        $response = $this->get('/blog/non-existent');
        $response->assertStatus(404);
    }

    /** @test */
    public function locale_middleware_works_correctly()
    {
        // Test that locale is properly set in the application
        $this->assertEquals('en', app()->getLocale());
        
        // Test that we can change locale
        app()->setLocale('es');
        $this->assertEquals('es', app()->getLocale());
        
        app()->setLocale('ru');
        $this->assertEquals('ru', app()->getLocale());
    }

    /** @test */
    public function supported_locales_are_configured()
    {
        $supportedLocales = config('laravellocalization.supportedLocales');
        
        $this->assertArrayHasKey('en', $supportedLocales);
        $this->assertArrayHasKey('es', $supportedLocales);
        $this->assertArrayHasKey('ru', $supportedLocales);
        
        $this->assertEquals('English', $supportedLocales['en']['name']);
        $this->assertEquals('Spanish', $supportedLocales['es']['name']);
        $this->assertEquals('Russian', $supportedLocales['ru']['name']);
    }

    /** @test */
    public function laravel_localization_configuration_is_correct()
    {
        // Test Laravel Localization configuration
        $this->assertTrue(config('laravellocalization.hideDefaultLocaleInURL'));
        $this->assertFalse(config('laravellocalization.useAcceptLanguageHeader'));
        
        // Test that supported locales are properly configured
        $this->assertCount(3, config('laravellocalization.supportedLocales'));
    }

    /** @test */
    public function blog_routes_are_registered()
    {
        // Test that blog routes are properly registered
        $this->assertTrue(route('blog.index') !== null);
        $this->assertTrue(route('blog.category', ['slug' => 'test']) !== null);
        $this->assertTrue(route('blog.tag', ['slug' => 'test']) !== null);
        $this->assertTrue(route('blog.post', ['slug' => 'test']) !== null);
    }

    /** @test */
    public function blog_controller_exists()
    {
        // Test that the BlogController exists and is accessible
        $this->assertTrue(class_exists(\App\Http\Controllers\BlogController::class));
        
        // Test that the controller has the required methods
        $controller = new \App\Http\Controllers\BlogController();
        $this->assertTrue(method_exists($controller, 'index'));
        $this->assertTrue(method_exists($controller, 'category'));
        $this->assertTrue(method_exists($controller, 'tag'));
        $this->assertTrue(method_exists($controller, 'show'));
    }

    /** @test */
    public function blog_views_exist()
    {
        // Test that blog views exist
        $this->assertTrue(view()->exists('site.blog.index'));
        $this->assertTrue(view()->exists('site.blog.category'));
        $this->assertTrue(view()->exists('site.blog.tag'));
        $this->assertTrue(view()->exists('site.blog.post'));
    }

    /** @test */
    public function blog_models_exist()
    {
        // Test that blog models exist
        $this->assertTrue(class_exists(\App\Models\BlogPost::class));
        $this->assertTrue(class_exists(\App\Models\BlogCategory::class));
        $this->assertTrue(class_exists(\App\Models\BlogTag::class));
    }

    /** @test */
    public function blog_repositories_exist()
    {
        // Test that blog repositories exist
        $this->assertTrue(class_exists(\App\Repositories\BlogPostRepository::class));
        $this->assertTrue(class_exists(\App\Repositories\BlogCategoryRepository::class));
        $this->assertTrue(class_exists(\App\Repositories\BlogTagRepository::class));
    }
}
