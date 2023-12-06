function addHall() {
    const addHallPopup = document.querySelector('#addHallPopup');
    addHallPopup.classList.add('active');
}

function deleteHall(event) {
    const deleteHallPopup = document.querySelector('#deleteHallPopup');
    deleteHallPopup.classList.add('active');
    const nameHall = document.querySelector('.conf-step__paragraph');
    const trashForm = document.querySelector('.trash-form');
    document.querySelector('.cancel').addEventListener('click', (e) => {
        e.preventDefault();
        deleteHallPopup.classList.remove('active');
    });
    nameHall.querySelector('span').textContent = event.target.closest('li').textContent;
    const hallID = event.target.closest('li').dataset.id;
    trashForm.action =  '/admin/delete_hall/' + hallID;
};
