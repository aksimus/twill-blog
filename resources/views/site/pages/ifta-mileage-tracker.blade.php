@extends('layouts.blog-layout')

@section('title', 'IFTA Mileage Tracker App – Auto Track State Miles by GPS')

@section('seo')
{{-- SEO meta tags are handled by the controller via SeoMetaService --}}
<x-seo-meta :seoMeta="$seoMeta ?? []" />
@endsection

@section('content')
@php
    $utm = 'utm_source=organic&utm_medium=landing&utm_campaign=ifta_tracker';
    $withUtm = fn (string $url) => $url . (str_contains($url, '?') ? '&' : '?') . $utm;

    $iosUrl = $withUtm('https://apps.apple.com/us/app/ifta-calculator-driver-app/id6759822043');
    $androidUrl = $withUtm('https://play.google.com/store/apps/details?id=pro.aksoft.gpstracker');
    $startFreeUrl = $withUtm('/mileage/register');
    $calculatorUrl = url('/');

    // App screenshots served statically on the same domain (eztools /mileage app).
    $screens = ['01', '03', '04', '05', '06', '07'];

    $flow = [
        ['icon' => 'bx bx-mobile-alt', 'title' => 'Driver drives', 'text' => 'Open the app and hit the road — nothing else to do.'],
        ['icon' => 'bx bx-map-alt', 'title' => 'GPS logs miles by state', 'text' => 'Every state line you cross is recorded automatically.'],
        ['icon' => 'bx bx-sync', 'title' => 'Miles flow into your report', 'text' => 'State-by-state miles feed straight into your IFTA report.'],
        ['icon' => 'bx bx-bar-chart-alt-2', 'title' => 'File in one click', 'text' => 'Generate your quarterly IFTA filing instantly.'],
    ];

    // FAQ — used for both the visible accordion and the FAQPage JSON-LD (kept 1:1).
    $faqs = [
        [
            'q' => 'How do I track my IFTA miles?',
            'a' => 'Install the IFTA Mileage Tracker app, sign in and start driving. The app uses your phone GPS to log how many miles you drive in each state, then feeds those state-by-state miles straight into your IFTA report — no manual logbook required.',
        ],
        [
            'q' => 'Is the IFTA mileage tracker app free?',
            'a' => 'Yes — you can start tracking your IFTA miles for free. Download the app, create an account and begin logging trips at no cost.',
        ],
        [
            'q' => 'Does it work without internet / offline?',
            'a' => 'Yes. The app keeps recording your GPS mileage even with no signal. Your trips sync automatically to your account as soon as you are back online.',
        ],
        [
            'q' => 'How accurate is GPS mileage for IFTA?',
            'a' => 'The app records GPS-accurate mileage and splits it precisely at each state line, so your per-jurisdiction totals are audit-ready and far more reliable than manual estimates.',
        ],
        [
            'q' => 'Can I export my miles to an IFTA report?',
            'a' => 'Absolutely. Tracked miles flow directly into your IFTA report, where you can review them and generate your quarterly filing. You can also open the full <a href="' . e($calculatorUrl) . '">IFTA calculator</a> at any time.',
        ],
        [
            'q' => 'Do I need a separate GPS device?',
            'a' => 'No. Your smartphone replaces expensive ELD or GPS hardware. There is nothing to buy, wire or install — the app turns the phone you already carry into your IFTA mileage tracker.',
        ],
        [
            'q' => 'Do you offer fleet / IFTA tracking software?',
            'a' => 'The app works great for owner-operators and small fleets alike. If you manage multiple trucks and are looking for IFTA tracking software, get in touch and start with the free app today.',
        ],
    ];
@endphp

<div class="imt">

    {{-- ================= HERO (H1 + first H2) ================= --}}
    <section class="imt-hero" id="top">
        <div class="imt-hero__copy">
            <h1 class="imt-h1">IFTA Mileage Tracker</h1>
            <h2 class="imt-hero__sub">Automatic state-by-state mileage tracking</h2>
            <p class="imt-lead">
                Track IFTA miles automatically. Our IFTA mileage tracker app logs your
                state-by-state miles by GPS — so you never keep a manual logbook again.
            </p>

            <div class="imt-cta">
                <a href="{{ $startFreeUrl }}" class="imt-btn imt-btn--primary">Start tracking free</a>
            </div>

            <div class="imt-stores" aria-label="Download the app">
                <a href="{{ $iosUrl }}" class="imt-store" target="_blank" rel="noopener">
                    <i class="bx bxl-apple" aria-hidden="true"></i>&nbsp;App Store
                </a>
                <a href="{{ $androidUrl }}" class="imt-store" target="_blank" rel="noopener">
                    <i class="bx bxl-play-store" aria-hidden="true"></i>&nbsp;Google Play
                </a>
            </div>
        </div>

        <div class="imt-hero__media">
            <img
                src="/mileage/media/mobile-app-screens/01.png"
                alt="IFTA mileage tracker app showing state-by-state miles on a map"
                width="300" height="650"
                class="imt-hero__phone"
            >
        </div>
    </section>

    {{-- ================= How it works ================= --}}
    <section class="imt-section" id="how-it-works">
        <h2 class="imt-h2">How the IFTA tracker app works</h2>

        <div class="imt-flow">
            @foreach($flow as $i => $step)
                <div class="imt-flow__step">
                    <div class="imt-flow__icon"><i class="{{ $step['icon'] }}" aria-hidden="true"></i></div>
                    <strong class="imt-flow__title">{{ $step['title'] }}</strong>
                    <p class="imt-flow__text">{{ $step['text'] }}</p>
                </div>
                @if($i < count($flow) - 1)
                    <div class="imt-flow__arrow" aria-hidden="true">
                        <span class="imt-flow__arrow--h">→</span>
                        <span class="imt-flow__arrow--v">↓</span>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="imt-how-detail">
            <h3 class="imt-h3">GPS logs every state line you cross</h3>
            <p>The moment you start driving, the app records your route and detects each border
               you cross, building an accurate mileage breakdown per jurisdiction.</p>

            <h3 class="imt-h3">Miles flow straight into your IFTA report</h3>
            <p>Your tracked miles are sent automatically into your
               <a href="{{ $calculatorUrl }}">IFTA calculator</a> — closing the manual data entry
               gap that used to slow down every quarter.</p>

            <h3 class="imt-h3">Generate your quarterly filing in one click</h3>
            <p>When the quarter closes, your state-by-state totals are already there. Review and
               generate your IFTA filing in a single click.</p>
        </div>
    </section>

    {{-- ================= App for drivers + gallery ================= --}}
    <section class="imt-section" id="app">
        <h2 class="imt-h2">IFTA mileage tracker app for drivers</h2>
        <p class="imt-gallery-label">What drivers see in the app</p>

        <div class="imt-gallery" id="imt-gallery">
            @foreach($screens as $n)
                <a
                    href="/mileage/media/mobile-app-screens/{{ $n }}.png"
                    class="gallery-item is-hovered rounded-3"
                    data-sub-html='<h6 class="fs-sm text-light">IFTA mileage tracker app — screen {{ $n }}</h6>'
                >
                    <img
                        src="/mileage/media/mobile-app-screens/{{ $n }}.png"
                        alt="IFTA mileage tracker app screen showing state-by-state miles"
                        loading="lazy" width="300" height="650"
                    >
                </a>
            @endforeach
        </div>

        <ul class="imt-features">
            <li><i class="bx bx-check" aria-hidden="true"></i> Automatic state detection</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> Offline mode — records with no signal</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> Export straight to your IFTA report</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> GPS-accurate mileage for truck drivers &amp; owner-operators</li>
        </ul>

        <div class="imt-stores">
            <a href="{{ $iosUrl }}" class="imt-store" target="_blank" rel="noopener">
                <i class="bx bxl-apple" aria-hidden="true"></i>&nbsp;App Store
            </a>
            <a href="{{ $androidUrl }}" class="imt-store" target="_blank" rel="noopener">
                <i class="bx bxl-play-store" aria-hidden="true"></i>&nbsp;Google Play
            </a>
        </div>
    </section>

    {{-- ================= GPS without a device ================= --}}
    <section class="imt-section" id="gps-tracking">
        <h2 class="imt-h2">GPS IFTA tracking without a separate device</h2>
        <p>Your phone replaces expensive ELD and GPS hardware. The app produces GPS-accurate
           mileage logs suitable for IFTA reporting — no extra box to buy or install.</p>
        <ul class="imt-features">
            <li><i class="bx bx-check" aria-hidden="true"></i> No extra device to buy</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> No wiring or installation</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> Works in any truck you drive</li>
            <li><i class="bx bx-check" aria-hidden="true"></i> Always in your pocket</li>
        </ul>
    </section>

    {{-- ================= Comparison table ================= --}}
    <section class="imt-section" id="comparison">
        <h2 class="imt-h2">App vs. spreadsheet vs. manual logbook</h2>
        <div class="imt-table-wrap">
            <table class="imt-table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">App</th>
                        <th scope="col">Spreadsheet</th>
                        <th scope="col">Paper logbook</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Auto-records miles</th>
                        <td class="imt-yes">Yes</td>
                        <td class="imt-no">No</td>
                        <td class="imt-no">No</td>
                    </tr>
                    <tr>
                        <th scope="row">Error risk</th>
                        <td class="imt-yes">Low</td>
                        <td>Medium</td>
                        <td class="imt-no">High</td>
                    </tr>
                    <tr>
                        <th scope="row">Time per quarter</th>
                        <td class="imt-yes">Minutes</td>
                        <td>Hours</td>
                        <td class="imt-no">Hours</td>
                    </tr>
                    <tr>
                        <th scope="row">Export to IFTA report</th>
                        <td class="imt-yes">One click</td>
                        <td>Manual</td>
                        <td class="imt-no">Manual</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="imt-note">Still using a spreadsheet? Switch to auto-tracking and let GPS log
           your state miles for you.</p>
    </section>

    {{-- ================= FAQ ================= --}}
    <section class="imt-section" id="faq">
        <h2 class="imt-h2">Frequently asked questions</h2>
        <div class="accordion" id="imt-faq">
            @foreach($faqs as $i => $faq)
                <div class="accordion-item">
                    <h3 class="accordion-header" id="imt-faq-h-{{ $i }}">
                        <button
                            class="accordion-button {{ $i === 0 ? '' : 'collapsed' }}"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#imt-faq-c-{{ $i }}"
                            aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                            aria-controls="imt-faq-c-{{ $i }}"
                        >
                            {{ $faq['q'] }}
                        </button>
                    </h3>
                    <div
                        id="imt-faq-c-{{ $i }}"
                        class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                        aria-labelledby="imt-faq-h-{{ $i }}"
                        data-bs-parent="#imt-faq"
                    >
                        <div class="accordion-body">{!! $faq['a'] !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= Final CTA ================= --}}
    <section class="imt-final">
        <h2 class="imt-h2">Start tracking your IFTA miles free</h2>
        <div class="imt-cta imt-cta--center">
            <a href="{{ $startFreeUrl }}" class="imt-btn imt-btn--primary">Start tracking free</a>
        </div>
        <div class="imt-stores imt-stores--center">
            <a href="{{ $iosUrl }}" class="imt-store" target="_blank" rel="noopener">
                <i class="bx bxl-apple" aria-hidden="true"></i>&nbsp;App Store
            </a>
            <a href="{{ $androidUrl }}" class="imt-store" target="_blank" rel="noopener">
                <i class="bx bxl-play-store" aria-hidden="true"></i>&nbsp;Google Play
            </a>
        </div>
    </section>

</div>

{{-- ================= Structured data ================= --}}
{{-- Initialise the lightbox with the vendor libraries already loaded by the layout --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('imt-gallery');
        if (!el || typeof window.lightGallery !== 'function'
            || el.dataset.lgInited || el.hasAttribute('lg-uid')) {
            return;
        }
        var plugins = [];
        if (typeof window.lgZoom !== 'undefined') plugins.push(window.lgZoom);
        if (typeof window.lgThumbnail !== 'undefined') plugins.push(window.lgThumbnail);
        if (typeof window.lgFullscreen !== 'undefined') plugins.push(window.lgFullscreen);

        window.lightGallery(el, {
            selector: '.gallery-item',
            plugins: plugins,
            licenseKey: 'D4194FDD-48924833-A54AECA3-D6F8E646',
            download: false,
            zoomFromOrigin: false,
        });
        el.dataset.lgInited = '1';
    });
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'MobileApplication',
    'name' => 'IFTA Mileage Tracker',
    'operatingSystem' => 'iOS, Android',
    'applicationCategory' => 'BusinessApplication',
    'description' => 'IFTA mileage tracker app that logs state-by-state miles automatically by GPS and sends them to your IFTA report.',
    'url' => 'https://ifta-calculator.com/ifta-mileage-tracker',
    'installUrl' => $iosUrl,
    'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD',
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'IFTA Calculator',
        'url' => 'https://ifta-calculator.com',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://ifta-calculator.com/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'IFTA Mileage Tracker', 'item' => 'https://ifta-calculator.com/ifta-mileage-tracker'],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => collect($faqs)->map(fn ($faq) => [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => strip_tags($faq['a']),
        ],
    ])->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<style>
.imt {
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 16px 48px;
    color: #1a1a18;
}

.imt-h1 {
    font-size: clamp(30px, 5vw, 44px);
    font-weight: 800;
    line-height: 1.1;
    margin: 0 0 8px;
}

.imt-h2 {
    font-size: clamp(22px, 3.5vw, 30px);
    font-weight: 700;
    margin: 0 0 18px;
}

.imt-h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 20px 0 6px;
}

/* Hero */
.imt-hero {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    align-items: center;
    padding: 20px 0 8px;
}

.imt-hero__sub {
    font-size: clamp(18px, 2.6vw, 22px);
    font-weight: 600;
    color: hsl(210, 82%, 40%);
    margin: 0 0 12px;
}

.imt-lead {
    font-size: 16px;
    line-height: 1.6;
    color: #4a4a45;
    max-width: 46rem;
    margin: 0 0 20px;
}

.imt-hero__media {
    text-align: center;
}

.imt-hero__phone {
    max-width: 260px;
    width: 100%;
    height: auto;
    border-radius: 22px;
    box-shadow: 0 20px 45px hsla(0, 0%, 0%, .18);
}

/* CTA + stores */
.imt-cta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 14px;
}

.imt-cta--center,
.imt-stores--center {
    justify-content: center;
}

.imt-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 48px;
    padding: 12px 26px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
}

.imt-btn--primary {
    background: hsl(210, 82%, 45%);
    color: #fff;
    border: 1px solid hsl(210, 82%, 45%);
}

.imt-btn--primary:hover {
    background: hsl(210, 82%, 38%);
    color: #fff;
}

.imt-stores {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.imt-store {
    display: inline-flex;
    align-items: center;
    min-height: 48px;
    padding: 10px 18px;
    border: 1px solid rgba(0, 0, 0, .22);
    border-radius: 10px;
    background: #fff;
    color: #1a1a18;
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
}

.imt-store:hover {
    background: #f5f5f0;
    color: #1a1a18;
}

.imt-store .bx {
    font-size: 20px;
}

/* Sections */
.imt-section {
    margin-top: 48px;
    padding-top: 28px;
    border-top: 1px solid hsl(0, 0%, 92%);
    scroll-margin-top: 16px;
}

.imt-section p {
    font-size: 16px;
    line-height: 1.6;
    color: #4a4a45;
}

/* Flow */
.imt-flow {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 8px;
}

.imt-flow__step {
    flex: 1;
    text-align: center;
    padding: 12px 8px;
}

.imt-flow__icon {
    width: 52px;
    height: 52px;
    margin: 0 auto 10px;
    border-radius: 50%;
    background: hsl(210, 82%, 96%);
    color: hsl(210, 82%, 42%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.imt-flow__title {
    display: block;
    font-size: 15px;
    margin-bottom: 4px;
}

.imt-flow__text {
    margin: 0;
    font-size: 14px;
    line-height: 1.45;
    color: #6b6b64;
}

.imt-flow__arrow {
    display: flex;
    align-items: center;
    justify-content: center;
    color: hsl(0, 0%, 70%);
    font-size: 22px;
}

.imt-flow__arrow--h { display: none; }

/* Gallery */
.imt-gallery-label {
    font-weight: 600;
    margin: 0 0 12px;
}

.imt-gallery {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 20px;
}

.imt-gallery .gallery-item {
    border: 1px solid hsl(0, 0%, 91%);
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 8px 18px hsla(0, 0%, 0%, .06);
}

.imt-gallery .gallery-item img {
    display: block;
    width: 100%;
    height: auto;
}

/* Features */
.imt-features {
    list-style: none;
    margin: 16px 0;
    padding: 0;
    display: grid;
    grid-template-columns: 1fr;
    gap: 10px;
}

.imt-features li {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    font-size: 15px;
    color: #34342f;
}

.imt-features .bx {
    color: hsl(140, 60%, 38%);
    font-size: 20px;
    line-height: 1.4;
}

/* Comparison table */
.imt-table-wrap { overflow-x: auto; }

.imt-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 520px;
}

.imt-table th,
.imt-table td {
    padding: 12px 14px;
    border: 1px solid hsl(0, 0%, 88%);
    text-align: left;
    font-size: 15px;
}

.imt-table thead th {
    background: hsl(0, 0%, 96%);
    font-weight: 700;
}

.imt-table tbody th {
    background: hsl(0, 0%, 98%);
    font-weight: 600;
}

.imt-table .imt-yes {
    color: hsl(140, 60%, 30%);
    font-weight: 600;
}

.imt-table .imt-no { color: hsl(0, 65%, 45%); }

.imt-note {
    margin-top: 14px;
    font-style: italic;
}

/* Final CTA */
.imt-final {
    margin-top: 48px;
    padding: 36px 20px;
    border-radius: 16px;
    background: hsl(210, 82%, 96%);
    text-align: center;
}

.imt-final .imt-h2 { margin-bottom: 20px; }

/* Responsive */
@media (min-width: 768px) {
    .imt-hero {
        grid-template-columns: 1.3fr 1fr;
    }
    .imt-flow {
        flex-direction: row;
        align-items: flex-start;
    }
    .imt-flow__arrow--h { display: inline; }
    .imt-flow__arrow--v { display: none; }
    .imt-flow__arrow {
        padding-top: 26px;
    }
    .imt-features {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (min-width: 720px) {
    .imt-gallery {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }
}
</style>
@endsection
