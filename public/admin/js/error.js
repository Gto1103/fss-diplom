export default function error(textErr) {

const errorPopup = document.querySelector('#error');
errorPopup.classList.add('active');
const textError = document.querySelector('.text__error');
textError.textContent = textErr;
}
