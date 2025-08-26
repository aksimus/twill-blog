<ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
    <a href="@localizedUrl('about')" class="nav-link">{{ __('About') }}</a>
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
  
  <!-- Account -->
  <li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ __('Account') }}</a>
    <ul class="dropdown-menu">
      <li><a href="#" class="dropdown-item">{{ __('Account Details') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Security') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Notifications') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Messages') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Saved Items') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('My Collections') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Payment Details') }}</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a href="#" class="dropdown-item">{{ __('Sign In') }}</a></li>
      <li><a href="#" class="dropdown-item">{{ __('Sign Up') }}</a></li>
    </ul>
  </li>
  
  <!-- UI Kit -->
  <li class="nav-item">
    <a href="#" class="nav-link">{{ __('UI Kit') }}</a>
  </li>
  
  <!-- Docs -->
  <li class="nav-item">
    <a href="#" class="nav-link">{{ __('Docs') }}</a>
  </li>
</ul>
