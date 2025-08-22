
#twill_blog_v01  //2025-08-21
done

- установлен laravel + twill + mcamara/laravel-localization
- добавлены Twill-модули  Page, blogPost, blogCategory, BlogTag
- реализована админка простейшего блога




#twill_blog_v02  //2025-08-22
done
- локализация разделов блога и страниц без префикса для дефолтного языка
- UI: переключатель языков
- UI: базовая навигация между разделами блога
- SEO meta 
    - link rel="alternate" hreflang="{lang}"
    - link rel="canonical"
    - другие
- тесты ./vendor/bin/phpunit --filter BlogUrlTest

#planning ( next steps)

##добаботка модуля pages
- адаптация под SEO - настраиваемые мета теги
- возможность вставки видео и галлереии изображений на страницу
- добавление микроразметки


