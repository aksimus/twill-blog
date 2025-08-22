<nav class="mb-10 border-b border-b-primary md:sticky md:z-10 md:top-0 md:py-5 md:bg-white">
    <div class="px-5 md:px-0">
        <!-- Main Navigation -->
        <div class="md:flex md:flex-row md:flex-nowrap md:justify-center md:items-center">
            <!-- Logo/Home Link -->
            <div class="py-5 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                <a href="@localizedUrl()" class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <!-- Main Navigation Links -->
            <div class="md:flex md:flex-row md:flex-nowrap md:items-center">
                <!-- Home -->
                <div class="py-3 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                    <a href="@localizedUrl()" class="text-gray-700 hover:text-blue-600 transition-colors">
                        {{ __('Welcome to Our Website') }}
                    </a>
                </div>

                <!-- Features -->
                <div class="py-3 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                    <a href="@localizedUrl('features')" class="text-gray-700 hover:text-blue-600 transition-colors">
                        {{ __('Key Features') }}
                    </a>
                </div>

                <!-- About -->
                <div class="py-3 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                    <a href="@localizedUrl('about')" class="text-gray-700 hover:text-blue-600 transition-colors">
                        {{ __('About') }}
                    </a>
                </div>

                <!-- Blog -->
                <div class="py-3 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                    <a href="@localizedUrl('blog')" class="text-gray-700 hover:text-blue-600 transition-colors">
                        {{ __('Blog') }}
                    </a>
                </div>

                <!-- Dynamic Twill Menu Links -->
                @if(isset($links) && $links->count() > 0)
                    @foreach($links as $link)
                        <div class="py-3 md:py-0 md:px-5 md:border-r md:border-r-secondary">
                            <a href="@localizedUrl($link->getRelated('page')->first()->slug)" 
                               class="text-gray-700 hover:text-blue-600 transition-colors">
                                {{$link->title}}
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>

