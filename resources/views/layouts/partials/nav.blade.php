<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
    <a href="@localizedUrl('rates')" class="nav-link">{{ __('IFTA tax rates') }}</a>
  </li>
  @if(!in_array(app()->environment(), ['production', 'local']))
  <!-- Home -->
  <li class="nav-item">
    <a href="@localizedUrl()" class="nav-link">{{ __('Home') }}</a>
  </li>


  
  <!-- Features -->
  <li class="nav-item">
    <a href="@localizedUrl('features')" class="nav-link">{{ __('Features') }}</a>
  </li>
  
  <!-- About -->
  <li class="nav-item">
    <a href="@localizedUrl('use-cases')" class="nav-link">{{ __('Use Cases') }}</a>
  </li>
  
  <!-- Blog -->
  <li class="nav-item dropdown">
    <a href="@localizedUrl('blog')" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('Blog') }}</a>
    <ul class="dropdown-menu">
      <li><a href="@localizedUrl('blog')" class="dropdown-item">{{ __('All Posts') }}</a></li>
      <li><a href="@localizedUrl('blog/tags')" class="dropdown-item">{{ __('Tags') }}</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><h6 class="dropdown-header">{{ __('Categories') }}</h6></li>
      @if(isset($categories) && $categories->count() > 0)
        @foreach($categories as $category)
          <li><a href="@localizedUrl('blog/category/' . $category->getSlug())" class="dropdown-item">{{ $category->title }}</a></li>
        @endforeach
      @endif
    </ul>
  </li>
  
  
  <!-- Dynamic Twill Menu Links -->
  @if(isset($links) && $links->count() > 0)
    @foreach($links as $link)
      <li class="nav-item">
        <a href="@localizedUrl($link->getRelated('page')->first()->slug)" class="nav-link">{{ $link->title }}</a>
      </li>
    @endforeach
  @endif
@endif
</ul>
