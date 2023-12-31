<div class="popup" id="deleteShowPopup">
    <div class="popup__container">
        <div class="popup__content">

            <div class="popup__header">
                <h2 class="popup__title">
                    Снятие с сеанса
                    <a class="popup__dismiss" href="#"><img src="{{ asset('admin/i/close.png') }}" alt="Закрыть"></a>
                </h2>
            </div>

            <div class="popup__wrapper">
                <form action="/admin/delete_seance" method="post" accept-charset="utf-8" id="delete_seance">

                    @csrf

                    <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span></span>?</p>
                    <!-- В span будет подставляться название фильма -->
                    <div class="conf-step__buttons text-center">
                        <input type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
                        <button class="cancel conf-step__button conf-step__button-regular">Отменить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
