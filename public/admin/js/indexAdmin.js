import accordeon from "./accordeon.js";
import close from "./close.js";
import hallConfig from "./hallConfig.js";
import priceConfig from "./priceConfig.js";
import addSeance from "./addSeance.js";
import deleteSeance from "./deleteSeance.js";
import viewSeances from "./viewSeances.js";
import error from "./error.js";
import inputError from "./inputError.js";

//получение данных с сервера

//получение таблицы с залами с сервера
const hallsTable = document.querySelector('.data-halls');
const hallsData = JSON.parse(hallsTable.value);

//получение фильмов
const moviesTable = document.querySelector('.data-movies');
const moviesData = JSON.parse(moviesTable.value).data;

//получение сеансов
const seancesTable = document.querySelector('.data-seances');
const seancesData = JSON.parse(seancesTable.value);

console.log(hallsData);
console.log(moviesData);
console.log(seancesData);

//сворачивание разделов
const headers = Array.from(document.querySelectorAll('.conf-step__header'));
if (!!headers) accordeon(headers);


//кнопка 'Отменить'
const dismiss = [...document.querySelectorAll('.popup__dismiss')];
const alert = [...document.querySelectorAll('.alert')];
const abort = [...document.querySelectorAll('.abort')];

abort.forEach(item => item.addEventListener('click', close));
dismiss.forEach(item => item.addEventListener('click', close));
alert.forEach(item => item.addEventListener('click', close));;


//кнопка 'Отмена' сохранения конфигурации залов, конфигурации цен, сеансов,
// с перезагрузкой страницы
const cancel = [...document.querySelectorAll('.cancel')];
cancel.forEach(item => {
    item.onclick = (e) => {
        e.preventDefault();
        location.reload();
    }
});

//проверка на некоторые символы, при вводе названи зала

const nameHall= document.querySelector('.name__cinema');
nameHall.addEventListener('change', function(e) {
    if (e.value === ' ') {
        error('Введите корректное название зала');
        nameHall.value = '';
        return;
    }
});

//выбор зала для конфигурации цены и изменение цены
const hallsListPrice = [...document.getElementsByName('chairs-hall-price')];

for (let i = 0; i < hallsListPrice.length; i++) {
    const choosenHall = i;
    let hallID = hallsListPrice[choosenHall].closest('li').dataset.id;
    priceConfig(hallsData, choosenHall, hallID);

    hallsListPrice[i].addEventListener('input', function(e) {
        hallID = e.target.closest('li').dataset.id;
        if (hallsListPrice[i].checked === true) {
            priceConfig(hallsData, choosenHall, hallID);
        }
    })
}


//выбор зала для конфигураций кресел
const hallsListSeat = [...document.getElementsByName('chairs-hall-seat')];


for (let i = 0; i < hallsListSeat.length; i++) {
    const choosenHall = i;
    let hallID = hallsListSeat[choosenHall].closest('li').dataset.id;
    hallConfig(hallsData, choosenHall, hallID);

    hallsListSeat[i].addEventListener('input', function(e) {
        hallID = e.target.closest('li').dataset.id;
        if (hallsListSeat[i].checked === true) {
            hallConfig(hallsData, choosenHall, hallID);
        }
    })
}


//отрисовка добавления фильма
const wrapperMovies = document.querySelector(".conf-step__movies");
let addMovie = "";

for (let i = 0; i < moviesData.length; i++) {
    addMovie += `
        <div class="conf-step__movie">
            <img class="conf-step__movie-poster" alt="poster" src="i/poster.png">
            <h3 class="conf-step__movie-title">${moviesData[i].title}</h3>
            <h6 class="conf-step__movie-description">Описание: ${moviesData[i].description}</h6>
            <p class="conf-step__movie-duration">${moviesData[i].duration} минут</p>
            <p class="conf-step__movie-country">Страна: ${moviesData[i].country}</p>
            <input class="movie_id" type="hidden" value=${moviesData[i].id} />
            <button class="conf-step__button conf-step__button-trash trash__movie" onclick="deleteMovie(event)""></button>
        </div>
    `;
}

wrapperMovies.innerHTML = addMovie;

// добавить-удалить сеанс
addSeance(hallsData, moviesData, seancesData);
deleteSeance(hallsData, moviesData, seancesData);

// отобразить сеанс
viewSeances(hallsData, moviesData, seancesData);

//кнопка открытия-закрытия продаж
const openSales = document.querySelector('#open_sales');

openSales.onclick = () => {
    if (!hallsData[choosenHall].is_open) {
        openSales.textContent = 'Приостановить продажу билетов';
        hallsData[choosenHall].is_open = true;
        saveHall();
    } else {
        openSales.textContent = 'Открыть продажу билетов';
        hallsData[choosenHall].is_open = false;
        saveHall();
    }
}

//проверка правильности ввода данных
inputError(moviesData, hallsData);

