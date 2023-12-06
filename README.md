# Дипломный проект по профессии «Веб-разработчик»

Дипломный проект представляет собой создание сайта для бронирования онлайн билетов в кинотеатр и разработка информационной системы для администрирования залов, сеансов и предварительного бронирования билетов.

### Студенту даются компоненты системы

- [Вёрстка](http://fs.sdew.ru/).

## Задачи

- Разработать сайт бронирования билетов онлайн.
- Разработать административную часть сайта.

## Сущности

1. **Кинозал**. Помещение, в котором демонстрируются фильмы. Режим работы определяется расписанием на день. Зал — прямоугольное помещение, состоит из N х M различных зрительских мест.
2. **Зрительское место**. Место в кинозале. Есть два вида: VIP и обычное.
3. **Фильм**. Информация о фильме заполняется администратором. Фильм связан с сеансом в кинозале.
4. **Сеанс**. Временной промежуток, во время которого в кинозале будет показываться фильм. На сеанс могут быть забронированы билеты.
5. **Билет**. QR-код c уникальным кодом бронирования, в котором обязательно указаны место, ряд, сеанс. Билет действителен строго на свой сеанс. Для генерации QR-кода можно использовать [сервис](http://phpqrcode.sourceforge.net/).

## Роли пользователей системы

- Администратор — авторизованный пользователь.
- Гость — неавторизованный посетитель сайта.

### Возможности администратора

- Создание или редактирование залов.
- Создание или редактирование списка фильмов.
- Настройка цен.
- Создание или редактирование расписания сеансов фильмов.

### Возможности гостя

- Просмотр расписания.
- Просмотр списка фильмов.
- Выбор места в кинозале.
- Бронирование билета на конкретную дату.

## Важные моменты

- Должна присутствовать валидация входных данных на стороне сервера.
- Пароль должен храниться в захешированном виде и при аутентификации должна быть проверка хеша пользователя.

## Этапы разработки

1. Продумайте архитектуру будущего веб-приложения. Выберите вариант реализации: SPA+API, Laravel App или Base PHP.
   Вы можете базироваться на основе фреймворков (Laravel, Yii2), использовать свободные библиотеки для сборки собственного приложения либо написать всё самостоятельно.
2. Проанализируйте задание, составьте план. Когда определитесь, что и как хотите делать, вы можете обсудить план с дипломным руководителем.
3. Разработайте административную и пользовательскую часть веб-приложения.

### Что в итоге должно получиться

В результате работы должен получиться git-репозиторий, содержащий в себе необходимые файлы проекта и файл ReadMe. В нём должна быть инструкция, как запустить ваш проект, технические особенности: версия php, процедура миграции базы данных и другое.

### Частые вопросы

> Что значит кнопка «Открыть продажу билетов»?

По умолчанию зал создаётся неактивным. После нажатия на эту кнопку зал становится доступным гостям. Надпись на кнопке меняется на «Приостановить продажу билетов».

> Должна ли быть регистрация из административной части сайта?

Регистрация из административной части сайта не является обязательной. Вы можете добавить эту функциональность по своему усмотрению или можете заносить в базу данных пользователей вручную при помощи миграций.

> Где брать модальные окна?

Файлы с припиской `_popup` — те самые модальные окна в папке «Вёрстка».

## Как задавать вопросы руководителю по дипломной работе

1. Если у вас возник вопрос, попробуйте сначала самостоятельно найти ответ в интернете. Навык поиска информации пригодится вам в любой профессиональной деятельности. Если ответ не нашёлся, можно уточнить у руководителя по дипломной работе.
2. Если у вас набирается несколько вопросов, присылайте их в виде нумерованного списка. Так дипломному руководителю будет проще отвечать на каждый из них.
3. Для лучшего понимания контекста прикрепите к вопросу скриншоты и стрелкой укажите, что именно вызывает вопрос. Программу для создания скриншотов можно скачать [по ссылке](https://app.prntscr.com/ru/).
4. По возможности задавайте вопросы в комментариях к коду.
5. Формулируйте свои вопросы чётко, дополняя их деталями. На сообщения «Ничего не работает», «Всё сломалось» дипломный руководитель не сможет дать комментарии без дополнительных уточнений. Это затянет процесс получения ответа.
6. Постарайтесь набраться терпения в ожидании ответа на свои вопросы. Дипломные руководители Нетологии – практикующие разработчики, поэтому они не всегда могут отвечать моментально. Зато их практика даёт возможность делиться с вами не только теорией, но и ценным прикладным опытом.

Рекомендации по работе над дипломом:

1. Не откладывайте надолго начало работы над дипломом. В таком случае у вас останется больше времени на получение рекомендаций от руководителя и доработку диплома.
2. Разбейте работу над дипломом на части и выполняйте их поочерёдно. Вы будете успевать учитывать комментарии от руководителя и не терять мотивацию на полпути.


Для развертывания приложения необходимо:

1. Изменить в файле env: 
DB_CONNECTION=sqlite
И удалить строчку:
DB_HOST=127.0.0.1

Или заменить файл env на env.example, удалив example.

2. Запустить миграции с постфиксом --seed.

3. Пароль для входа в администраторскую:
	'email' => 'admin@mail.ru'
	'password' => '11111111'