<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('css/language-switcher.css') }}">
    
    <x-seo-meta 
        title="{{ __('Welcome to Our Website') }}"
        description="{{ __('This is the homepage of our multilingual website built with Twill CMS.') }}"
        type="website"
    />
    
    @vite('resources/css/app.css')
</head>
<body>
    <x-menu/>
    
    <x-language-switcher />
    
    <div class="mx-auto max-w-6xl px-5 md:px-0">
        <!-- Hero Section -->
        <div class="mt-16 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-6">
                {{ __('Welcome to Our Website') }}
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                {{ __('This is the homepage of our multilingual website built with Twill CMS.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/features') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    {{ __('Features') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="{{ url('/blog') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    {{ __('Read Our Blog') }}
                </a>
            </div>
        </div>

        <!-- Features Preview -->
        <div class="mt-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">{{ __('Key Features') }}</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('24/7 Support') }}</h3>
                    <p class="text-gray-600">{{ __('Round the clock customer support to help you with any questions.') }}</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Secure & Reliable') }}</h3>
                    <p class="text-gray-600">{{ __('Enterprise-grade security and reliability for your peace of mind.') }}</p>
                </div>
                
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('Lightning Fast') }}</h3>
                    <p class="text-gray-600">{{ __('Optimized performance for the best user experience.') }}</p>
                </div>
            </div>
        </div>

        <!-- Blog Preview -->
        <div class="mt-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">{{ __('Latest from Our Blog') }}</h2>
                <a href="{{ url('/blog') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    {{ __('View All Posts') }} →
                </a>
            </div>
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">{{ __('Blog Coming Soon') }}</h3>
                <p class="text-gray-600 mb-4">{{ __('We\'re working on some great content. Check back soon!') }}</p>
                <a href="{{ url('/blog') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    {{ __('Visit Blog') }}
                </a>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <div class="bg-blue-600 rounded-lg p-8 text-white">
                <h2 class="text-3xl font-bold mb-4">{{ __('Ready to Get Started?') }}</h2>
                <p class="text-xl mb-6 opacity-90">{{ __('Join thousands of satisfied customers today.') }}</p>
                <a href="{{ url('/features') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-medium rounded-lg hover:bg-gray-100 transition-colors">
                    {{ __('Learn More') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>
