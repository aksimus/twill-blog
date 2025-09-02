#VERSION NOTES
##полезные команды
docker exec -it  iftacalc_frontsite  bash
docker exec -it  iftacalc_app  bash
docker container restart iftacalc_nginx

###Сборка фронтэнда app
docker run --rm --interactive --tty --volume ./eztools:/var/hosts/ifta-calculator.com node:10 sh -c "cd /var/hosts/ifta-calculator.com && node -v && npm install && npm run watch"
docker run --rm --interactive --tty --volume ./eztools:/var/hosts/ifta-calculator.com node:10 sh -c "cd /var/hosts/ifta-calculator.com && node -v && npm install && npm run prod"

###Сборка фронтэнда frontsite
docker run --rm --interactive --tty --volume ./frontsite:/var/hosts/frontsite  --publish 5173:5173 --publish 3001:3001 node:21 sh -c "cd /var/hosts/frontsite && node -v && npm install && npm run dev"
docker run --rm --interactive --tty --volume ./frontsite:/var/hosts/frontsite  node:21 sh -c "cd /var/hosts/frontsite && node -v && npm install && npm run build"



#twill_blog_v08 - вмержились в основной проект 


##todo 
- перенастроить пути на /calculator
- переделать ifta-rates ( работа через БД )

- редиректы старых страниц /login /register /account /forgot-password


- подключить events.js
- настроить staging (с SSl)
- настроить CI/CD 
- переделать ссылки в рассылках

- протестировать 
-- oauth
-- генерацию отчетов
-- переходы по ссылкам из почты





to consider
- bug: элемент top не работает корректно на других страницах //веременно отключен
- избавиться от шаки всегда сверху
- перенести faq в БД и сделать управляемым через CMS
- сделать promolink упрвляемым через CMS ( с пепрреводами )

- избавиться от fe-lib и font-awesome ( заменить на boxicons)


- добавление генерации Содержания на основе хеадеров
- другие контент блоки: цитата, pros & cons, 
- добавление микроразметки
- редирект с трейлинг слешем





