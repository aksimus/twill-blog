<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RatesController extends Controller
{
    /**
     * Display rates for a specific year and quarter
     */
    public function show(int $year, int $quarter): View
    {
        // Validate quarter (should be 1-4)
        if ($quarter < 1 || $quarter > 4) {
            abort(404, 'Invalid quarter. Quarter must be between 1 and 4.');
        }

        // Validate year (reasonable range)
        if ($year < 2000 || $year > 2030) {
            abort(404, 'Invalid year. Year must be between 2000 and 2030.');
        }

        // Get quarter information
        $quarterInfo = $this->getQuarterInfo($quarter);
        
        // Get rates data for the specified year and quarter
        $rateList = $this->getRateList($year, $quarter);
        
        // Get navigation data for other quarters/years
        $navigation = $this->getNavigationData($year, $quarter);

        return view('site.rates.show', compact('year', 'quarter', 'quarterInfo', 'rateList', 'navigation'));
    }

    /**
     * Display rates index page
     */
    public function index(): View
    {
        $currentYear = now()->year;
        $currentQuarter = ceil(now()->month / 3);
        
        // Get available years and quarters
        $availableYears = range(2014, $currentYear + 1);
        $quarters = [4, 3, 2, 1]; // Reverse order as in Vue component
        
        // Get latest rates
        $rateList = $this->getRateList($currentYear, $currentQuarter);
        
        return view('site.rates.index', compact('currentYear', 'currentQuarter', 'availableYears', 'quarters', 'rateList'));
    }

    /**
     * Get quarter information
     */
    private function getQuarterInfo(int $quarter): array
    {
        $quarters = [
            1 => [
                'name' => 'Q1',
                'full_name' => 'First Quarter',
                'months' => ['January', 'February', 'March'],
                'start_month' => 1,
                'end_month' => 3,
                'display' => '1 (January to March)'
            ],
            2 => [
                'name' => 'Q2',
                'full_name' => 'Second Quarter',
                'months' => ['April', 'May', 'June'],
                'start_month' => 4,
                'end_month' => 6,
                'display' => '2 (April to June)'
            ],
            3 => [
                'name' => 'Q3',
                'full_name' => 'Third Quarter',
                'months' => ['July', 'August', 'September'],
                'start_month' => 7,
                'end_month' => 9,
                'display' => '3 (July to September)'
            ],
            4 => [
                'name' => 'Q4',
                'full_name' => 'Fourth Quarter',
                'months' => ['October', 'November', 'December'],
                'start_month' => 10,
                'end_month' => 12,
                'display' => '4 (October to December)'
            ]
        ];

        return $quarters[$quarter] ?? [];
    }

    /**
     * Get rate list data from remote API
     */
    private function getRateList(int $year, int $quarter): array
    {
        // Create cache key for this specific year/quarter combination
        $cacheKey = "ifta_rates_{$year}_{$quarter}";
        
        // Try to get from cache first
        return Cache::remember($cacheKey, 3600, function () use ($year, $quarter) {
            try {
                // Fetch data from remote API
                $response = Http::timeout(10)->get("https://ifta-calculator.com/api/demo-rates/{$year}/{$quarter}");
                
                if ($response->successful()) {
                    $data = $response->json();
                    
                    // Transform the API response to match our expected format
                    $rates = [];
                    if (isset($data['data']) && is_array($data['data'])) {
                        foreach ($data['data'] as $rate) {
                            $rates[] = [
                                'country' => $rate['country'] ?? '',
                                'jurisdiction' => $rate['jurisdiction'] ?? '',
                                'year' => $rate['year'] ?? $year,
                                'quarter' => $rate['quarter'] ?? $quarter,
                                'value' => $rate['value'] ?? '0.00000',
                                'surcharge_value' => $rate['surcharge_value'] ?? '0.00000'
                            ];
                        }
                    }
                    
                    return $rates;
                }
                
                // If API call fails, log the error and return empty array
                Log::warning("Failed to fetch IFTA rates from API for {$year} Q{$quarter}. Status: " . $response->status());
                return [];
                
            } catch (\Exception $e) {
                // Log the exception and return empty array
                Log::error("Exception while fetching IFTA rates from API for {$year} Q{$quarter}: " . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get navigation data for other quarters/years
     */
    private function getNavigationData(int $year, int $quarter): array
    {
        $currentYear = now()->year;
        $currentQuarter = ceil(now()->month / 3);

        $navigation = [
            'previous' => null,
            'next' => null,
            'current' => [
                'year' => $year,
                'quarter' => $quarter
            ],
            'available_years' => range(2014, $currentYear + 1),
            'quarters' => [4, 3, 2, 1] // Reverse order as in Vue component
        ];

        // Calculate previous quarter/year
        if ($quarter > 1) {
            $navigation['previous'] = [
                'year' => $year,
                'quarter' => $quarter - 1
            ];
        } elseif ($year > 2014) {
            $navigation['previous'] = [
                'year' => $year - 1,
                'quarter' => 4
            ];
        }

        // Calculate next quarter/year
        if ($quarter < 4) {
            $navigation['next'] = [
                'year' => $year,
                'quarter' => $quarter + 1
            ];
        } elseif ($year < $currentYear + 1) {
            $navigation['next'] = [
                'year' => $year + 1,
                'quarter' => 1
            ];
        }

        return $navigation;
    }
}
