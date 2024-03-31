const seanceTable = document.querySelector('.data-seance');
const seance = JSON.parse(seanceTable.value);
console.log(seance);

const ticketTable = document.querySelector('.data-ticket');
const ticket = JSON.parse(ticketTable.value);
const seats = JSON.parse(ticket.selected_seats);

console.log(ticket);
console.log(seats);

document.querySelector('.ticket__title').textContent = ticket.title_movie;
document.querySelector('.ticket__chairs').textContent = seatsForTicket();
document.querySelector('.ticket__hall').textContent = `${ticket.name_hall}`;
document.querySelector('.ticket__start').textContent =`${seance.start}`;

function seatsForTicket() {
    let result = '';
    for (let seat of seats) {
        result += `Ряд ${seat.row} Место ${seat.seat}; `;
    }
    result = result.slice(0, -2);
    return result;
}
