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
        return view('site.homepage', compact('seoMeta'));


       
    }

	public function iftaTracker(): View
	{
		$seoMeta = $this->getSeoMeta([
			'title' => 'IFTA Mileage Tracker App – Auto Track State Miles by GPS',
			'description' => 'Track IFTA miles automatically. Our IFTA mileage tracker app logs state-by-state miles by GPS and feeds them straight into your IFTA report. Free to start.',
			'type' => 'website',
			'keywords' => 'ifta tracking, ifta mileage tracker, ifta tracker, ifta mileage tracker app, ifta tracking app, gps ifta tracking, ifta tracking spreadsheet, state to state mileage tracker',
			'canonical' => 'https://ifta-calculator.com/ifta-mileage-tracker',
			'image' => 'https://ifta-calculator.com/mileage/media/mobile-app-screens/01.png',
		]);

		return view('site.pages.ifta-mileage-tracker', compact('seoMeta'));
	}
}
