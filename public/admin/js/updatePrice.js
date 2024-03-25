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
}
