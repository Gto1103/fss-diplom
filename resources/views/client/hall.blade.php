<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ИдёмВКино</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
</head>

<body>
    <header class="page-header">
        <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    </header>

    <!-- данные с сервера -->
    <input class="data-seance" type="hidden" value="{{ json_encode($seance) }}" />
    <input class="data-movie" type="hidden" value="{{ json_encode($movie) }}" />
    <input class="data-hall" type="hidden" value="{{ json_encode($hall) }}" />
    <input class="data-seats" type="hidden" value="{{ json_encode($seats) }}" />


    <main>
        <section class="buying">
            <div class="buying__info">
                <div class="buying__info-description">
                    <h2 class="buying__info-title">Звёздные войны XXIII: Атака клонированных клонов</h2>
                    <p class="buying__info-start">Начало сеанса: 18:30</p>
                    <p class="buying__info-hall">Зал 1</p>
                </div>
                <div class="buying__info-hint">
                    <p>Тапните дважды,<br>чтобы увеличить</p>
                </div>
            </div>

            <div class="buying-scheme">
                <div class="buying-scheme__wrapper">
                </div>

                <div class="buying-scheme__legend">
                    <div class="col">
                        <p class="buying-scheme__legend-price"><span
                                class="buying-scheme__chair buying-scheme__chair_standart no_click"></span> Свободно (
                            <span class="buying-scheme__legend-value st_chair"> 250 </span> руб )
                        </p>
                        <p class="buying-scheme__legend-price"><span
                                class="buying-scheme__chair buying-scheme__chair_vip no_click"></span> Свободно VIP (
                            <span class="buying-scheme__legend-value vip_chair"> 350 </span> руб )
                        </p>
                    </div>
                    <div class="col">
                        <p class="buying-scheme__legend-price"><span
                                class="buying-scheme__chair buying-scheme__chair_taken no_click"></span> Занято</p>
                        <p class="buying-scheme__legend-price"><span
                                class="buying-scheme__chair buying-scheme__chair_selected no_click"></span> Выбрано</p>
                    </div>
                </div>
            </div>
            <div class="buying-total">
                <p class="buying-total__text">Общая стоимость: <span class="buying-total__price">0</span> руб</p>
            </div>

            <form action="/client/payment" id="selectSeats" method="post">

                @csrf

                <input class="data-tables-total-price" name="data-tables-total-price" type="hidden" />
                <input class="data-tables-seance-seats" name="data-tables-seance-seats" type="hidden" />
                <input class="data-tables-selected-seats" name="data-tables-selected-seats" type="hidden" />

                <!-- <button class="acceptin-button" onclick="location.href='payment.html'" >Забронировать</button> -->

                <input type="submit" value="Забронировать" class="acceptin-button"></input>
            </form>
        </section>
    </main>


    <script type="module" src="../js/hall.js"></script>

</body>

</html>
