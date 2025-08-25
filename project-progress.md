
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
- seeder php artisan blog:seed-test-data

#twill_blog_v03  //2025-08-22
done
- extended seeder ( страницы + много постов)   php artisan db:seed
- страница /blog/tags
- виджет с категориями на главной блога
- настраиваемая пагинация постов на category + tag



#twill_blog_v04  //2025-08-22
done
- адаптация под SEO - настраиваемые мета теги для Page
- возможность вставки Youtube видео и галлереии изображений на страницу ( Yotube twill block)


#planning ( next steps) -
#twill_blog_v05  //2025-08-25
добавляем в блог тему Silicon https://silicon.createx.studio/docs/getting-started.html


##добаботка модуля blogCategory, BlogTag

- добавление генерации Содержания на основе хеадеров
- другие контент блоки
- добавление микроразметки



