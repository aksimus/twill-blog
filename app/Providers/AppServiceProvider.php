<?php

namespace App\Providers;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Services\Settings\SettingsGroup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\UrlHelper;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\View\Components\Navigation\NavigationLink;

class AppServiceProvider extends ServiceProvider
{
	public function register()
	{
	}

	public function boot(): void
	{
		// Register Blade directive for localized URLs
		Blade::directive('localizedUrl', function ($expression) {
			return "<?php echo \\App\\Helpers\\UrlHelper::localizedUrl($expression); ?>";
		});

		TwillNavigation::addLink(
			NavigationLink::make()->forModule('pages')
		);
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('menuLinks')->title('Menu')
		);
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('blogCategories')->title('Blog Categories')
		);
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('blogTags')->title('Blog Tags')
		);
		TwillNavigation::addLink(
			NavigationLink::make()->forModule('blogPosts')->title('Blog Posts')
		);
		TwillAppSettings::registerSettingsGroup(
			SettingsGroup::make()->name('homepage')->label('Homepage')
		);
	}
}
