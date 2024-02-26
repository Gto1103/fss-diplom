function updatePrice() {

    //загрузка цен с сервера
    let price = document.querySelector('.price');
    let vip_price = document.querySelector('.vip_price');

    price.value = hallsData[choosenHall].price;
    vip_price.value = hallsData[choosenHall].vip_price;

    //изменение цены
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
            return null;
        }
        hallsData[choosenHall].vip_price = e.target.value;
    }


//сохранение hall/updatePrice
const formUpdatePrice = document.getElementById('hall_updatePrice');
formUpdatePrice.onsubmit = function(e) {
    e.preventDefault();

    /* const seatsArr1 = [];
    for (let i = 0; i < hallsData[choosenHall].seat.length; i++) {
        const type =  hallsData[choosenHall].seat[i];
        seatsArr1.push({hall_id: hallsData[choosenHall].id, type_seat: type});
    }
    delete hallsData[choosenHall].seat;
    document.querySelector('.data-tables').value = hallsData[choosenHall];*/

    const optionsHalls = {
        method: 'POST',
        body: JSON.stringify(hallsData[choosenHall]),
        headers: {'Content-Type': 'application/json'}
    }

    fetch(`/updatePrice/${hallsData[choosenHall].id}`, optionsHalls)
    .then(res=> {
        res.json();
        if (res.ok) {
            alert('save');
        } else {
            throw new Error(res.status);
        }
    })
}


  //  jsonFetch(`/halls/updatePrice/${hallsData[choosenHall].id}`, optionsHalls);
}
