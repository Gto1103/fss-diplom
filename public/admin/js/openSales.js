export default function openSales(hallsData, choosenHall) {

    //кнопка открытия-закрытия продаж
    const openSales = document.querySelector('#open_sales');
    let dataSales = document.querySelector('.data-tables-sales');

    //отображение правильного написания кнопки
    if (hallsData[choosenHall].is_open) {
        openSales.textContent = 'Приостановить продажу билетов';
    } else {
        openSales.textContent = 'Открыть продажу билетов';
    }

    openSales.onclick = () => {
        if (hallsData[choosenHall].is_open) {
            hallsData[choosenHall].is_open = 0;
            dataSales.value = JSON.stringify(hallsData[choosenHall].is_open);
            updateSales(hallsData[choosenHall].id);
        } else {
            hallsData[choosenHall].is_open = 1;
            dataSales.value = hallsData[choosenHall].is_open;
            updateSales(hallsData[choosenHall].id);
        }
    }

    //сохранение updateSales
    function updateSales(hallID) {
        dataSales.value = JSON.stringify(hallsData[choosenHall].is_open);
        const formUpdateSales = document.getElementById('updateSales');
        formUpdateSales.action =  '/admin/updateSales/' + hallID;
    }
}
