import error from "./error.js";

export default function hallConfig(hallsData, choosenHall, seatsData, hallID) {

/*

  //сохранение updatePrice
    const formUpdatePrice = document.getElementById('updatePrice');
  //if () когда цена VIP меньше обычной ???
    formUpdatePrice.action =  '/admin/updatePrice/' + hallID;

*/

    console.log(seatsData);
    console.log(seatsData[choosenHall]);

    let rows = document.querySelector('.rows');
    let cols = document.querySelector('.cols');
    let addSeat = '';
    let type = 'conf-step__chair_standart';
    let i = 0;
    let numbers = rows.value*cols.value;

 //загрузка кресел с сервера

    if (!!hallsData[choosenHall].rows & !!hallsData[choosenHall].cols) {
        rows.value = hallsData[choosenHall].rows;
        cols.value = hallsData[choosenHall].cols;
        schemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);
    } else {
        rows.value = 0;
        cols.value = 0;
    }

    //изменение конфигурации кресел

    const openSales = document.querySelector('#open_sales');
    if (hallsData[choosenHall].is_open) {
        openSales.textContent = 'Приостановить продажу билетов';
    } else {
        openSales.textContent = 'Открыть продажу билетов';
    }

    // изменение рядов и кресел

    rows.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value < 1 || value > 30) {
            rows.value = hallsData[choosenHall].rows;
            error('Введите корректное значение рядов (от 0 до 30)');
            return;
        }
        hallsData[choosenHall].rows = e.target.value;
        schemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);
    }

    cols.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value < 1 || value > 30) {
            cols.value = hallsData[choosenHall].cols;
            error('Введите корректное значение кресел (от 0 до 30)');
            return;
        }
        hallsData[choosenHall].cols = e.target.value;
        schemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);
    }

    function schemeSeats(rows, cols) {
    const wrapper = document.querySelector('.conf-step__hall-wrapper');

    for (let row = 0; row < rows; row++) {
        addSeat += '<div class="conf-step__row">';
        for (let col = 0; col < cols; col++) {
            if (seatsData[choosenHall].type_seat[i] === 'vip') {
                type = 'conf-step__chair_vip';
            } else if (seatsData[choosenHall].type_seat[i] === 'disabled') {
                type = 'conf-step__chair_disabled';
            } else {
                type = 'conf-step__chair_standart';
            }
            addSeat += `<span class="seat conf-step__chair ${type}"></span>`;
            i++;
        }
        addSeat += '</div>';
    }

    wrapper.innerHTML = addSeat;
    addSeat = '';
}

    //изменение вида кресла
    const seats = [...document.getElementsByClassName('seat')];

    console.log(seats.length);

    for (let i = 0; i < seats.length; i++) {
        seats[i].addEventListener('click', function() {
            if (seatsData[choosenHall].type_seat[i] === 'standart') {
                seats[i].classList.toggle('conf-step__chair_standart');
                seats[i].classList.toggle('conf-step__chair_vip');
                seatsData[choosenHall].type_seat[i] = 'vip';
            } else if (seatsData[choosenHall].type_seat[i] === 'disabled') {
                seats[i].classList.toggle('conf-step__chair_disabled');
                seats[i].classList.toggle('conf-step__chair_standart');
                seatsData[choosenHall].type_seat[i] = 'standart';
            } else if (seatsData[choosenHall].type_seat[i] === 'vip') {
                seats[i].classList.toggle('conf-step__chair_vip');
                seats[i].classList.toggle('conf-step__chair_disabled');
                seatsData[choosenHall].type_seat[i] = 'disabled';
            } else {
                seats[i].classList.add('conf-step__chair_standart');
                seatsData[choosenHall].type_seat[i] = 'standart';
            }
        })
    }


}
