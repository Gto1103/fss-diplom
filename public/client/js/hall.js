//получение данных с сервера
//получение таблицы с сеансами с сервера
const seanceTable = document.querySelector('.data-seance');
const seance = JSON.parse(seanceTable.value);

//получение зала с сервера
const hallTable = document.querySelector('.data-hall');
const hall = JSON.parse(hallTable.value);

//получение фильма с сервера
const movieTable = document.querySelector('.data-movie');
const movie = JSON.parse(movieTable.value);


//получение зала с сервера
const seatsTable = document.querySelector('.data-seats');
const seatsArr = JSON.parse(seatsTable.value);

const seats = [];
seats.seance_seats = seatsArr;

console.log(seance);
console.log(hall);
console.log(movie);
console.log(seatsArr);


document.querySelector('.buying__info-title').textContent = `Фильм: ${movie.title}`;
document.querySelector('.buying__info-start').textContent = `Начало сеанса: ${seance.start}`;
document.querySelector('.buying__info-hall').textContent = `Зал: ${hall.name}`;
document.querySelector('.st_chair').textContent = `${hall.price}`;
document.querySelector('.vip_chair').textContent = `${hall.vip_price}`;

//отображение кресел
let addSeats = '';
let s = 0;
const classSeat = [
    'buying-scheme__chair_standart',
    'buying-scheme__chair_disabled',
    'buying-scheme__chair_vip',
    'buying-scheme__chair_taken',
    'buying-scheme__chair_selected'
]

let typeSeat = classSeat[0];
for (let i = 0; i < hall.rows; i++) {
    addSeats += '<div class="buying-scheme__row">';
    for (let j = 0; j < hall.cols; j++) {
        if (seatsArr[s] == 'standart') {
            typeSeat = classSeat[0];
        } else if (seatsArr[s] == 'disabled') {
            typeSeat = classSeat[1];
        } else if (seatsArr[s] == 'vip') {
            typeSeat = classSeat[2];
        } else {
            typeSeat = classSeat[3];
        }
        addSeats += `<span class="buying-scheme__chair ${typeSeat}"></span>`;
        s++;
    }
    addSeats += '</div>';
}
document.querySelector('.buying-scheme__wrapper').innerHTML = addSeats;


//выбор кресел
const chosenChairs = [];
const rowAndSeat = [];
const chairs = [...document.querySelectorAll('.buying-scheme__chair')];
let totalPrice = 0;
const selectedSeats = seatsArr.slice(0);

for (let i = 0; i < chairs.length; i++) {
    chairs[i].onclick = () => {

        if (chairs[i].classList.contains('no_click')) {
            return null;
        }

        if (chairs[i].classList.contains(classSeat[1])
            || chairs[i].classList.contains(classSeat[3])) {
            return null;
        }

        if (chairs[i].classList.contains(classSeat[4])) {
            chairs[i].classList.remove(classSeat[4]);
            if (seatsArr[i] == 'vip') {
                chairs[i].classList.add(classSeat[2]);
                actionSeats(hall.vip_price, 'remove', i);
            } else {
                chairs[i].classList.add(classSeat[0]);
                actionSeats(hall.price, 'remove', i);
            }

            return null;
        }

        if (chairs[i].classList.contains(classSeat[0])) {
            chairs[i].classList.remove(classSeat[0]);
            chairs[i].classList.add(classSeat[4]);
            actionSeats(hall.price, 'add');
            return null;
        }

        if (chairs[i].classList.contains(classSeat[2])) {
            chairs[i].classList.remove(classSeat[2]);
            chairs[i].classList.add(classSeat[4]);
            actionSeats(hall.vip_price, 'add');
            return null;
        }

        function actionSeats (price, action) {
            if (action === 'add'){
                totalPrice += +price;
                document.querySelector('.buying-total__price').textContent = totalPrice;
                selectedSeats[i] = 'selected';
                chosenChairs.push(seats.seance_seats[i]);
                rowAndSeat.push(seatInHall(i));
            }

            if (action === 'remove'){
                totalPrice -= +price;
                document.querySelector('.buying-total__price').textContent = totalPrice;
                selectedSeats[i] = seatsArr[i];
                let index = chosenChairs.indexOf(seatsArr[i]);
                chosenChairs.splice(index, 1);
                rowAndSeat.forEach((item, index) => {
                    if (item.id === i+1) rowAndSeat.splice(index, 1);
                });
            }

        seats.selected_seats = rowAndSeat;
        seats.seance_seats = selectedSeats;

        let seatsTableSeance = document.querySelector('.data-tables-seance-seats');
        seatsTableSeance.value = JSON.stringify(seats.seance_seats);

        let seatsTableSelected = document.querySelector('.data-tables-selected-seats');
        seatsTableSelected.value = JSON.stringify(seats.selected_seats);
        console.log(seats);

        }
    }
}
/*
hallsData[choosenHall].seats = JSON.stringify(seatsArr);
        let seatsTable = document.querySelector('.data-tables-seats');
        seatsTable.value = JSON.stringify(hallsData);
    }

   //сохранение updateSeats
    const formUpdateSeats = document.getElementById('updateSeats');
    formUpdateSeats.action =  '/admin/updateSeats/';
    */


//обработка отправки формы
document.querySelector('.acceptin-button').addEventListener('click', (e) => {
    e.preventDefault();
    if (rowAndSeat.length < 1) return null;

    for (let i = 0; i < selectedSeats.length; i++) {
        rowAndSeat.forEach(rowSeat => {
            if (i+1 === rowSeat.id) {
                selectedSeats[i] = 'taken';
            }
        });
    }
    /*
    seats.selected_seats = rowAndSeat;
    seats.seance_seats = selectedSeats;

    seatsData = JSON.stringify(seats);
    let seatsTableOutput = document.querySelector('.data-tables-seats');
    seatsTableOutput.value = JSON.stringify(seatsData);

    const options = {
        method: "POST",
        body: JSON.stringify(seance),
        headers: {"Content-Type": "application/json"}
    }
    */

    location.href = `/client/payment/${seance.id}`;
})


//перевести номер seat в ряд и место в зале
function seatInHall(num) {
    const row = Math.floor(num/hall.cols) + 1;
    const firstSeatOfRow = hall.cols * (row - 1 );
    const lastSeatOfRow = hall.cols + firstSeatOfRow - 1;
    let s = 1;
    for (let i = lastSeatOfRow; i >= firstSeatOfRow; i--) {
        if (seatsArr[i] !== 'disabled' && i > num) {
            s++;
        } else if (seatsArr[i] === 'disabled') {
            continue;
        } else {
            break;
        }
    }
    //return `Ряд ${row}, Место ${s} `
    return {id: num+1, row: row, seat: s, type: seatsArr[num]};
}
