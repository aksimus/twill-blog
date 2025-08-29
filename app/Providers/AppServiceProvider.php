<?php

namespace App\Providers;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Services\Settings\SettingsGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\UrlHelper;
use App\Services\SeoMetaService;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;

class AppServiceProvider extends ServiceProvider
{
	public function register()
	{
		// Register SEO Meta Service
		$this->app->singleton(SeoMetaService::class, function ($app) {
			return new SeoMetaService($app->make(\App\Services\ContentLanguageSwitcherService::class));
		});
	}

	public function boot(): void
	{
		// Register Blade directive for localized URLs
		Blade::directive('localizedUrl', function ($expression) {
			return "<?php echo \\App\\Helpers\\UrlHelper::localizedUrl($expression); ?>";
		});

		// Register Blade directive for SEO meta tags
		Blade::directive('seoMeta', function ($expression) {
			return "<?php echo app(\\App\\Services\\SeoMetaService::class)->generateMetaTags($expression); ?>";
		});

		// Main modules
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('pages')
		);
		
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('menuLinks')->title('Menu')
		);

		// Blog-related modules (visually grouped by consistent naming)
		TwillNavigation::addLink(
			NavigationLink::make()
				->forModule('blogPosts')
				->title('📝 Blog Posts')
		);

		TwillNavigation::addLink(
			NavigationLink::make()
				->forModule('blogCategories')
				->title('📂 Blog Categories')
		);

		TwillNavigation::addLink(
			NavigationLink::make()
				->forModule('blogTags')
				->title('🏷️ Blog Tags')
		);

		TwillNavigation::addLink(
			NavigationLink::make()
				->forModule('blogAuthors')
				->title('👤 Blog Authors')
		);

		// App settings
		TwillAppSettings::registerSettingsGroup(
			SettingsGroup::make()->name('homepage')->label('Homepage')
		);
	}
}
