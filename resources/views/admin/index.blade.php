<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ИдёмВКино</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
</head>

<body>

    <!-- Добавление всех всплывающих окон на страницу -->

    @include('admin.popups.hall_add_popup')
    @include('admin.popups.hall_delete_popup')
    @include('admin.popups.movie_add_popup')
    @include('admin.popups.movie_delete_popup')
    @include('admin.popups.showtime_add_popup')
    @include('admin.popups.showtime_delete_popup')
    @include('admin.popups.error')

    <!-- все залы из table-halls в $halls -->

    <input class="data-halls" type="hidden" value="{{ json_encode($halls) }}" />
    <input class="data-movies" type="hidden" value="{{ json_encode($movies) }}" />
    <input class="data-seances" type="hidden" value="{{ json_encode($seances) }}" />

    <header class="page-header">
        <h1 class="page-header__title">Идём<span>в</span>кино</h1>
        <span class="page-header__subtitle">Администраторррская</span>
    </header>

    <main class="conf-steps">
        <section class="conf-step">
            <header class="conf-step__header conf-step__header_opened"">
                <h2 class="conf-step__title">Управление залами</h2>
            </header>
            <div class="conf-step__wrapper">
                <p class="conf-step__paragraph">Доступные залы:</p>
                <ul class="conf-step__list">
                    @foreach ($halls as $hall)
                        <li data-id="{{ $hall->id }}">{{ $hall->name }}
                            <button class="conf-step__button conf-step__button-trash trash_hall"
                                onclick="deleteHall(event)"></button>
                        </li>
                    @endforeach
                </ul>
                <button class="conf-step__button conf-step__button-accent" onclick="addHall()">Создать зал</button>
            </div>
        </section>

        <section class="conf-step">
            <form action="/admin/updateSeats" id="updateSeats" method="post">

                @csrf

                <input class="data-tables-seats" name="data-tables-seats" type="hidden" />

                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Конфигурация залов</h2>
                </header>
                <div class="conf-step__wrapper">
                    <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
                    <ul class="conf-step__selectors-box">
                        @foreach ($halls as $hall)
                            <li data-id="{{ $hall->id }}">
                                <input type="radio" class="conf-step__radio" name="chairs-hall-seat"
                                    value="{{ $hall->id }}" checked><span
                                    class="conf-step__selector">{{ $hall->name }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:
                    </p>
                    <div class="conf-step__legend">
                        <label for="rows" class="conf-step__label">Рядов, шт
                            <input type="number" name="rows" id="rows" class="conf-step__input rows"
                                placeholder="10" min="0" max="30">
                        </label>
                        <span class="multiplier">x</span>
                        <label for="cols" class="conf-step__label">Мест, шт
                            <input type="number" name="cols" id="cols" class="conf-step__input cols"
                                placeholder="8" min="0" max="30">
                        </label>
                    </div>
                    <p class="conf-step__paragraph">Теперь
                        вы можете указать типы кресел на схеме зала:</p>
                    <div class="conf-step__legend">
                        <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
                        <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
                        <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет
                        кресла)
                        <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши
                        </p>
                    </div>

                    <div class="conf-step__hall">
                        <div class="conf-step__hall-wrapper">
                            <!-- Создание схемы расстановки кресел -->
                        </div>
                    </div>

                    <fieldset form="updateSeats" class="conf-step__buttons text-center">
                        <button class="cancel conf-step__button conf-step__button-regular">Отмена</button>
                        <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                    </fieldset>
            </form>
        </section>

        <section class="conf-step">
            <form action="/admin/updatePrice" id="updatePrice" method="post">

                @csrf

                <header class="conf-step__header conf-step__header_opened">
                    <h2 class="conf-step__title">Конфигурация цен</h2>
                </header>
                <div class="conf-step__wrapper">
                    <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
                    <ul class="conf-step__selectors-box">
                        @foreach ($halls as $hall)
                            <li data-id="{{ $hall->id }}">
                                <input type="radio" class="conf-step__radio" name="chairs-hall-price" checked><span
                                    class="conf-step__selector">{{ $hall->name }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
                    <div class="conf-step__legend">
                        <label for="price" class="conf-step__label">Цена, рублей
                            <input type="number" name="price" id="price" placeholder="100" min="0"
                                max="5000" class="conf-step__input price" placeholder="0"></label>
                        за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
                    </div>
                    <div class="conf-step__legend">
                        <label for="vip_price" class="conf-step__label">Цена, рублей
                            <input type="number" name="vip_price" id="vip_price" placeholder="200" min="0"
                                max="5000" class="conf-step__input vip_price" placeholder="0"></label>
                        за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
                    </div>

                    <fieldset form="updatePrice" class="conf-step__buttons text-center">
                        <button class="cancel conf-step__button conf-step__button-regular">Отмена</button>
                        <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                    </fieldset>
                </div>

            </form>
        </section>

        <section class="conf-step">
            <header class="conf-step__header conf-step__header_opened">
                <h2 class="conf-step__title">Сетка сеансов</h2>
            </header>
            <div class="conf-step__wrapper">
                <p class="conf-step__paragraph">
                    <button class="conf-step__button conf-step__button-accent" onclick="addMovie()">
                        Добавить фильм
                    </button>
                </p>
                <div class="conf-step__movies">
                    <!-- Создание списка фильмов-->
                </div>
                <div>
                    <p class="conf-step__paragraph" style="margin: 20px">Для добавления фильма к сеансу, нажмите на
                        фильм</p>
                </div>

                <form action="/admin/updateSeances" id="updateSeances" method="post">

                    @csrf

                    <input class="data-tables-seances" name="data-tables-seances" type="hidden" />
                    <div class="conf-step__seances">
                        <!--  Добавление сеансов -->
                    </div>

                    <fieldset class="conf-step__buttons text-center" form="updateSeances">
                        <button class="cancel conf-step__button conf-step__button-regular">Отмена</button>
                        <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                    </fieldset>
                </form>
            </div>
        </section>


        <section class="conf-step">
            <header class="conf-step__header conf-step__header_opened">
                <h2 class="conf-step__title">Открыть продажи</h2>
            </header>
            <div class="conf-step__wrapper text-center">
                <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
                <button class="conf-step__button conf-step__button-accent" id="open_sales">
                    Открыть продажу билетов
                </button>
            </div>
        </section>
    </main>


    <script type="module" src="js/indexAdmin.js" defer></script>
    <script src="js/addDeleteHall.js"></script>
    <script src="js/addDeleteMovie.js"></script>
    <script type="module" src="js/addSeance.js"></script>
    <script type="module" src="js/deleteSeance.js"></script>
    <script type="module" src="js/viewSeances.js"></script>
    <script type="module" src="js/sortSeances.js"></script>
    <script type="module" src="js/timeToMinutes.js"></script>
</body>

</html>
