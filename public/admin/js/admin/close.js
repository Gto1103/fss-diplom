export default function close(e) {
    e.preventDefault();
    const popup = [...document.querySelectorAll('.popup')];
    for (let i = 0; i < alert.length; i++) {
        alert[i].textContent = null;
    }
    for (let i = 0; i < popup.length; i++) {
        if (popup[i].classList.contains('active')) {
            popup[i].classList.remove('active');
        }
    }
}
