export default function accordeon(headers){
    headers.forEach(header => header.addEventListener('click', () => {
        header.classList.toggle('conf-step__header_closed');
        header.classList.toggle('conf-step__header_opened');
    }));
}
