import error from "./error.js";

export default function priceConfig(hallsData, choosenHall, hallID) {

    //загрузка цен с сервера
    let price = document.querySelector('.price');
    let vip_price = document.querySelector('.vip_price');

    price.value = hallsData[choosenHall].price;
    vip_price.value = hallsData[choosenHall].vip_price;

    //изменение цены
    price.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value <= 0 || value > 5000) {
            document.querySelector('.price').value = hallsData[choosenHall].price;
            error('Введите корректное значение цены');
        }
        hallsData[choosenHall].price = e.target.value;
    }

    vip_price.onchange = (e) => {
        const value = parseInt(e.target.value);
        if (value <= 0 || value > 5000) {
            document.querySelector('.vip_price').value = hallsData[choosenHall].price_vip;
            error('Введите корректное значение цены');
        }
        hallsData[choosenHall].vip_price = e.target.value;
    }


    //сохранение updatePrice
    const formUpdatePrice = document.getElementById('updatePrice');
    //if () когда цена VIP меньше обычной ???
    formUpdatePrice.action =  '/admin/updatePrice/' + hallID;
}
