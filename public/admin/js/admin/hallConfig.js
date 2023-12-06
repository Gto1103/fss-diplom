export default function hallConfig(hallsData, choosenHall, seatsData) {

    console.log(seatsData);
    console.log(seatsData[choosenHall]);



    if (!!hallsData[choosenHall].rows & !!hallsData[choosenHall].cols) {
        document.querySelector('.rows').value = hallsData[choosenHall].rows;
        document.querySelector('.cols').value = hallsData[choosenHall].cols;}
    else {
        document.querySelector('.rows').value = '0';
        document.querySelector('.cols').value = '0';
    }




    const openSales = document.querySelector('#open_sales');
    if (hallsData[choosenHall].is_open) {
        openSales.textContent = 'Приостановить продажу билетов';
    } else {
        openSales.textContent = 'Открыть продажу билетов';
    }

    const wrapper = document.querySelector('.conf-step__hall-wrapper');

    let type = 'conf-step__chair_standart';
    let i = 0;
    let addSeat = '';
    let rows = hallsData[choosenHall].rows;
    let cols = hallsData[choosenHall].cols;
   // let numbers = rows*cols;

//дальше делать отсюда



    //заполнение схемы кресел
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

    //изменение вида кресла
    const seats = [...document.getElementsByClassName('seat')];
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
