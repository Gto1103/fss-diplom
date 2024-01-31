<div class="popup" id="addMoviePopup">
    <div class="popup__container">
        <div class="popup__content">
            <div class="popup__header">

                <h2 class="popup__title">
                    Добавление фильма
                    <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть"></a>
                </h2>

            </div>
            <div class="popup__wrapper">
                <form action="/admin/add_movie" method="post" accept-charset="utf-8" id="addMovie">

                    @csrf

                    <label class="conf-step__label conf-step__label-fullsize" for="movie-title">
                        Название фильма
                        <input class="conf-step__input" id="movie-title" type="text"
                            placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="title" required>
                    </label>
                    <label class="conf-step__label conf-step__label-fullsize" for="movie-description">
                        Описание фильма
                        <input class="conf-step__input" id="movie-description" type="text"
                            placeholder="Например, &laquo;Действия происходят в новой Галактике и так далее...&raquo;"
                            name="description" required>
                    </label>
                    <label class="conf-step__label conf-step__label-fullsize" for="movie-dur">
                        Продолжительность фильма, мин
                        <input class="conf-step__input" id="movie-dur" type="number" min="0" max="5000"
                            placeholder="Например, &laquo;120&raquo;" name="duration" required>
                    </label>
                    <label class="conf-step__label conf-step__label-fullsize" for="movie-country">
                        Страна производства
                        <input class="conf-step__input" id="movie-country" type="text"
                            placeholder="Например, &laquo;Россия&raquo;" name="country" required>
                    </label>
                    <div class="alert"></div>
                    <div class="conf-step__buttons text-center">
                        <input type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent">
                        <button class="abort conf-step__button conf-step__button-regular">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
