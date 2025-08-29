<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;
use App\Repositories\PageRepository;
use App\Traits\HasSeoMeta;
use Illuminate\Contracts\View\View;

class PageDisplayController extends Controller
{
	use HasSeoMeta;
	
	public function show(string $slug, PageRepository $pageRepository): View
	{
		$page = $pageRepository->forSlug($slug);

		if (!$page) {
			abort(404);
		}

		// Share SEO meta data for page
		$this->shareSeoMeta($this->getPageSeoMeta($page));

		return view('site.page', ['item' => $page]);
	}

    public function home(): View
    {
		$seoMeta = $this->getSeoMeta();
        if (TwillAppSettings::get('homepage.homepage.page')->isNotEmpty()) {
            /** @var \App\Models\Page $frontPage */
            $frontPage = TwillAppSettings::get('homepage.homepage.page')->first();

            if ($frontPage->published) {
                return view('site.page', array_merge(['item' => $frontPage], compact('seoMeta')));
            }
        }

        abort(404);
        // Get SEO meta data for homepage
       
    }
}
