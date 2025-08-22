@if($allCategories && $allCategories->count() > 0)
    <div class="mb-8 p-6 bg-white rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('Categories') }}</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach($allCategories as $category)
                <a href="@localizedUrl('blog/category/' . $category->getSlug())" 
                   class="group p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-900 group-hover:text-blue-700 transition-colors">
                            {{ $category->title }}
                        </span>
                        <span class="text-sm text-gray-500 group-hover:text-blue-600 transition-colors">
                            {{ $category->posts_count ?? 0 }}
                        </span>
                    </div>
                    
                    @if($category->description)
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            {{ \Illuminate\Support\Str::limit($category->description, 60) }}
                        </p>
                    @endif
                </a>
            @endforeach
        </div>
        
        <div class="mt-4 pt-4 border-t border-gray-200">
            <a href="@localizedUrl('blog')" 
               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors">
                {{ __('View All Categories') }}
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
@endif 