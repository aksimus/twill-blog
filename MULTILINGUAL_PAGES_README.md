# Multilingual Pages and Blog System

This document describes the multilingual pages and blog functionality built with Twill CMS and Laravel Localization.

## 🌐 Overview

The system provides a complete multilingual website with:
- **Pages Module**: Homepage, Features, About, and custom pages
- **Blog Module**: Categories, Tags, and Posts with multilingual support
- **Language Switcher**: Seamless navigation between English, Spanish, and Russian
- **SEO Meta Tags**: Including hreflang for international targeting

## 🏗️ Architecture

### Routes Structure
```
/                    → English homepage (no prefix)
/es                 → Spanish homepage
/ru                 → Russian homepage

/features           → English features page
/es/features       → Spanish features page
/ru/features       → Russian features page

/about              → English about page
/es/about          → Spanish about page
/ru/about          → Russian about page

/blog               → English blog index
/es/blog           → Spanish blog index
/ru/blog           → Russian blog index

/blog/category/{slug}     → English category page
/es/blog/category/{slug}  → Spanish category page
/ru/blog/category/{slug}  → Russian category page

/blog/tag/{slug}          → English tag page
/es/blog/tag/{slug}       → Spanish tag page
/ru/blog/tag/{slug}       → Russian tag page

/blog/{slug}              → English blog post
/es/blog/{slug}           → Spanish blog post
/ru/blog/{slug}           → Russian blog post
```

### Key Components

#### 1. Main Menu (`<x-menu />`)
- **Logo/Home**: Links to homepage
- **Features**: Links to features page
- **About**: Links to about page
- **Blog**: Links to blog index
- **Dynamic Links**: Additional Twill menu links

#### 2. Language Switcher (`<x-language-switcher />`)
- Shows current language with flag
- Lists available languages
- Generates content-aware URLs
- Handles unavailable content gracefully

#### 3. SEO Meta Component (`<x-seo-meta />`)
- Basic meta tags (title, description, viewport)
- Open Graph tags
- Twitter Card tags
- Canonical URLs
- Hreflang links for multilingual SEO

## 📄 Pages Module

### Available Pages
1. **Homepage** (`/`)
   - Hero section with call-to-action
   - Key features overview
   - Blog preview section
   - Call-to-action for features

2. **Features Page** (`/features`)
   - Detailed feature descriptions
   - Rich content blocks via Twill

3. **About Page** (`/about`)
   - Company information
   - Mission and values
   - Team information

### Page Structure
Each page includes:
- Multilingual title and description
- Language switcher
- SEO meta tags
- Responsive design
- Twill block editor support

## 📝 Blog Module

### Content Types
1. **Blog Categories**
   - Multilingual titles and descriptions
   - Slug-based routing
   - Post relationships

2. **Blog Tags**
   - Multilingual titles and descriptions
   - Many-to-many relationship with posts
   - Tag-based filtering

3. **Blog Posts**
   - Multilingual titles and descriptions
   - Category assignment
   - Multiple tag support
   - Rich content blocks
   - Publication status

### Blog Views
1. **Blog Index** (`/blog`)
   - List of all published posts
   - Post previews with excerpts
   - Category and tag links
   - Pagination support

2. **Category Pages** (`/blog/category/{slug}`)
   - Posts filtered by category
   - Category information
   - Navigation breadcrumbs

3. **Tag Pages** (`/blog/tag/{slug}`)
   - Posts filtered by tag
   - Tag information
   - Related tags

4. **Post Pages** (`/blog/{slug}`)
   - Full post content
   - Category and tag links
   - Breadcrumb navigation
   - Social sharing

## 🚀 Getting Started

### 1. Seed Test Data
```bash
# Seed pages and blog data
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan db:seed

# Or seed individually
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan pages:seed-test-data
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan blog:seed-test-data
```

### 2. Access Admin Panel
- **URL**: `/cms`
- **Modules**: Pages, Blog Categories, Blog Tags, Blog Posts
- **Features**: Content creation, translation management, media uploads

### 3. Test Multilingual URLs
- English: `/`, `/features`, `/about`, `/blog`
- Spanish: `/es`, `/es/features`, `/es/about`, `/es/blog`
- Russian: `/ru`, `/ru/features`, `/ru/about`, `/ru/blog`

## 🔧 Configuration

### Laravel Localization
```php
// config/laravellocalization.php
'supportedLocales' => [
    'en' => [
        'name' => 'English',
        'script' => 'Latn',
        'native' => 'English',
        'regional' => 'en_GB'
    ],
    'es' => [
        'name' => 'Spanish',
        'script' => 'Latn',
        'native' => 'Español',
        'regional' => 'es_ES'
    ],
    'ru' => [
        'name' => 'Russian',
        'script' => 'Cyrl',
        'native' => 'Русский',
        'regional' => 'ru_RU'
    ]
],
'hideDefaultLocaleInURL' => true
```

### Twill Configuration
```php
// config/twill.php
'namespace' => 'App',
'admin_path' => 'cms'
```

## 🎨 Customization

### Adding New Pages
1. Create page in Twill admin (`/cms/pages`)
2. Add translations for each language
3. Set slug for each language
4. Publish the page

### Adding New Blog Content
1. Create categories and tags first
2. Create blog posts with category and tag assignments
3. Add translations for each language
4. Set slugs for each language
5. Publish the content

### Styling
- CSS classes use Tailwind CSS
- Responsive design with mobile-first approach
- Custom language switcher styles in `public/css/language-switcher.css`

## 🧪 Testing

### Run Tests
```bash
# Run all tests
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan test

# Run specific test file
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan test --filter=BlogUrlTest

# Run specific test method
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan test --filter=test_multilingual_pages_work_correctly
```

### Test Coverage
- URL routing for all languages
- Content display in correct language
- Language switcher functionality
- SEO meta tag generation
- Navigation and breadcrumbs

## 📱 Responsive Design

The system is fully responsive with:
- Mobile-first approach
- Tablet and desktop optimizations
- Touch-friendly navigation
- Readable typography at all screen sizes

## 🌍 Internationalization

### Language Support
- **English**: Default language (no URL prefix)
- **Spanish**: `/es` prefix
- **Russian**: `/ru` prefix

### Content Translation
- All user-facing text is translatable
- Language files: `lang/en.json`, `lang/es.json`, `lang/ru.json`
- Automatic locale detection
- Fallback to default language

### SEO Features
- Hreflang tags for search engines
- Canonical URLs to prevent duplicate content
- Language-specific meta descriptions
- Open Graph and Twitter Card support

## 🔍 Troubleshooting

### Common Issues

1. **404 Errors on Localized Routes**
   - Ensure pages are published in Twill admin
   - Check that slugs exist for each language
   - Verify Laravel Localization middleware is working

2. **Language Switcher Not Working**
   - Check if content exists in target language
   - Verify slug generation for each locale
   - Ensure routes are properly registered

3. **Content Not Displaying in Correct Language**
   - Check locale setting in middleware
   - Verify translation records exist
   - Ensure active status is set correctly

### Debug Commands
```bash
# Check routes
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan route:list

# Check configuration
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan config:show laravellocalization

# Clear caches
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan cache:clear
docker exec -it tmpl-laravel_11-scaffold-app-1 php artisan view:clear
```

## 📚 Additional Resources

- [Twill CMS Documentation](https://twillcms.com/)
- [Laravel Localization Package](https://github.com/mcamara/laravel-localization)
- [Laravel 11 Documentation](https://laravel.com/docs/11.x)

## 🤝 Contributing

To add new features or fix issues:
1. Update language files for all supported locales
2. Add tests for new functionality
3. Update this documentation
4. Test in all supported languages

---

**Last Updated**: {{ date('Y-m-d') }}
**Version**: 1.0.0 