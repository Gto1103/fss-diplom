import error from "./error.js";

export default function hallConfig(hallsData, choosenHall) {
    let rows = document.querySelector('.rows');
    let cols = document.querySelector('.cols');

    //загрузка кресел выбранного зала
    let seatsArr = JSON.parse(hallsData[choosenHall].seats);

    // проверка на пустые значения кресел и рядов с сервера
    if (!!hallsData[choosenHall].rows & !!hallsData[choosenHall].cols) {
        rows.value = hallsData[choosenHall].rows;
        cols.value = hallsData[choosenHall].cols;
    } else {
        rows.value = 0;
        cols.value = 0;
    }

    // изменение рядов и кресел
    rows.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value < 1 || value > 20) {
            rows.value = hallsData[choosenHall].rows;
            error('Введите корректное значение рядов (от 0 до 20)');
            return;
        }
        hallsData[choosenHall].rows = parseInt(e.target.value);
        changeSchemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);
    }

    cols.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value < 1 || value > 20) {
            cols.value = hallsData[choosenHall].cols;
            error('Введите корректное значение кресел (от 0 до 20)');
            return;
        }
        hallsData[choosenHall].cols = parseInt(e.target.value);
        changeSchemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);
    }

    //изменение конфигурации кресел
    changeSchemeSeats(hallsData[choosenHall].rows, hallsData[choosenHall].cols);

    function changeSchemeSeats(rows, cols) {
        const wrapper = document.querySelector('.conf-step__hall-wrapper');
        let addSeat = '';
        let type = 'conf-step__chair_standart';
        let i = 0;

        // отрисовка кресел
        for (let row = 0; row < rows; row++) {
            addSeat += '<div class="conf-step__row">';
            for (let col = 0; col < cols; col++) {
                if (seatsArr[i] === 'vip') {
                    type = 'conf-step__chair_vip';
                } else if (seatsArr[i] === 'disabled') {
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

        //изменение вида кресла
        const seats = [...document.getElementsByClassName('seat')];

        if (seatsArr.length > seats.length) {
            seatsArr = [];
        }
        if (seatsArr.length === 0) {
            for (let i = 0; i < seats.length; i++) {
                seatsArr[i] = 'standart';
            }
        }
        if (seatsArr.length < seats.length) {
            for (let i = seatsArr.length; i < seats.length; i++) {
                seatsArr[i] = 'standart';
            }
        }

        for (let i = 0; i < seats.length; i++) {
            seats[i].addEventListener('click', function(e) {
            if (seatsArr[i] == 'standart') {
                seats[i].classList.toggle('conf-step__chair_standart');
                seats[i].classList.toggle('conf-step__chair_vip');
                seatsArr[i] = 'vip';
            } else if (seatsArr[i] == 'vip') {
                seats[i].classList.toggle('conf-step__chair_vip');
                seats[i].classList.toggle('conf-step__chair_disabled');
                seatsArr[i] = 'disabled';
            } else if (seatsArr[i] == 'disabled') {
                seats[i].classList.toggle('conf-step__chair_disabled');
                seats[i].classList.toggle('conf-step__chair_standart');
                seatsArr[i] = 'standart';
            } else {
                seats[i].classList.add('conf-step__chair_standart');
                seatsArr[i] = 'standart';
            }
            hallsData[choosenHall].seats = JSON.stringify(seatsArr);
            let seatsTable = document.querySelector('.data-tables-seats');
            seatsTable.value = JSON.stringify(hallsData);
        })
        }

        hallsData[choosenHall].seats = JSON.stringify(seatsArr);
        let seatsTable = document.querySelector('.data-tables-seats');
        seatsTable.value = JSON.stringify(hallsData);
    }

   //сохранение updateSeats
    const formUpdateSeats = document.getElementById('updateSeats');
    formUpdateSeats.action =  '/admin/updateSeats/';
}
