import accordeon from "./accordeon.js";
import close from "./close.js";
import jsonFetch from "./jsonFetch.js";
import hallConfig from "./hallConfig.js";
import priceConfig from "./priceConfig.js";
import inputError from "./inputError.js";

/*
получение данных с сервера
получение таблицы с залами с сервера
*/
const hallsTable = document.querySelector('.data-halls');
const hallsData = JSON.parse(hallsTable.value);

//получение кресел
const seatsTable = document.querySelector('.data-seats');
const seatsData = JSON.parse(seatsTable.value);

//получение фильмов
const moviesTable = document.querySelector('.data-movies');
const moviesData = JSON.parse(moviesTable.value).data;

//получение сеансов
const seancesTable = document.querySelector('.data-seances');
const seancesData = JSON.parse(seancesTable.value);

console.log(hallsData);
console.log(seatsData);
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
    hallConfig(hallsData, choosenHall, seatsData, hallID);

    hallsListSeat[i].addEventListener('input', function() {
        let choosenHall = i;
        hallsListSeat[i].checked = true;
        hallConfig(hallsData, choosenHall, seatsData, hallID);
    })
}


//установление выбранного зала для отображения
if (hallsData.length > 0) {
    let choosenHall = hallsData.length - 1;
    hallConfig(hallsData, choosenHall, seatsData);
}



//Проверка данных с сервера на наличие залов с рядами
/*
if (!!seatsData) {
    hallsData.map(hall => {
    const arr = [];

    for (let i = 0; i < hall.seat.length; i++) {
        arr.push(hall.seat[i].type_seat);
    }
    hall.seat = arr;
})}
*/


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
/*

function saveHall() {
    const options = {
        method: 'POST',
        body: JSON.stringify(hallsData[choosenHall]),
        headers: {'Content-Type': 'application/json'}
    }

    jsonFetch(`/halls/updatePrice/${hallsData[choosenHall].id}`, options);
}

//проверка правильности ввода данных
//inputError(moviesData, hallsData);


//изменение цены
console.log(document.querySelector('.price'));
document.querySelector('.price').onchange = (e) => {
    const value = parseInt(e.target.value);
    if (!Number.isInteger(value) || value <= 0) {
        document.querySelector('.price').value = hallsData[choosenHall].price;
        return null;
    }
    hallsData[choosenHall].price = e.target.value;
}

document.querySelector('.vip_price').onchange = (e) => {
    const value = parseInt(e.target.value);
    if (!Number.isInteger(value) || value <= 0) {
        document.querySelector('.vip_price').value = hallsData[choosenHall].price_vip;
        return null
    }
    hallsData[choosenHall].price_vip = e.target.value;
}

//сохранение hall_update
const formUpdatePrice = document.getElementById('hall_updatePrice');
formUpdatePrice.onsubmit = function(e) {
    e.preventDefault();

const seatsArr1 = [];
    for (let i = 0; i < hallsData[choosenHall].seat.length; i++) {
        const type =  hallsData[choosenHall].seat[i];
        seatsArr1.push({hall_id: hallsData[choosenHall].id, type_seat: type});
    }
    delete hallsData[choosenHall].seat;
    document.querySelector('.data-tables').value = hallsData[choosenHall];

    const optionsHalls = {
        method: 'POST',
        body: JSON.stringify(hallsData[choosenHall]),
        headers: {'Content-Type': 'application/json'}
    }

    jsonFetch(`/halls/updatePrice/${hallsData[choosenHall].id}`, optionsHalls);
}




    const optionsSeats = {
        method: 'POST',
        body: JSON.stringify(seatsArr1),
        headers: {'Content-Type': 'application/json'}
    }

        jsonFetch(`/api/seats/${hallsData[choosenHall].id}`, optionsSeats);
}
*/
